<?php

namespace App\Console\Commands;

use App\AppUserActivation;
use App\Exceptions\UpdateProbablyFailedException;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Jobs\ProcessTextFilterArchiveUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Sentry\State\Scope;

class ReportUpdateFailed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sentry:report_update_failed';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!app()->bound('sentry')) {
            $this->error("Sentry is not bound");
            return;
        }

        $this->info("Checking users");
        $this->exec();
        $this->info("finished");
    }

    public function exec()
    {
        if (app()->bound('sentry')) {
            $appUserActivations = AppUserActivation::where("last_update_requested_time", ">", DB::raw("DATE_SUB(NOW(), INTERVAL 1 DAY)"))
                ->where("last_sync_time", "<", DB::raw("last_update_requested_time"))
                ->where("last_sync_time", "<", DB::raw("DATE_SUB(NOW(), INTERVAL 2 HOUR)"))
                ->where("last_sync_time", ">", DB::raw("DATE_SUB(NOW(), INTERVAL 1 WEEK)"))
                ->get()
                ->all();
            $maxVersionToAlertUpdate = config("app.max_version_alert_update");

            $date = Carbon::now()->toDateString();

            foreach ($appUserActivations as $appUserActivation) {
                $v = $appUserActivation->app_version;
                if (version_compare($v, $maxVersionToAlertUpdate) < 0) {
                    $id = $appUserActivation->identifier;
                    $email = $appUserActivation->user->email;

                    \Sentry\withScope(function (Scope $scope) use ($email, $id, $date) {
                        $scope->setUser([
                            'id' => $email . ":" . $id
                        ]);
                        $scope->setTag('date', $date);
                        \Sentry\captureException(new UpdateProbablyFailedException($date . ": User probably didn't sync after update"));
                        $this->info("User " . $email);
                    });
                }
            }
        }
    }
}

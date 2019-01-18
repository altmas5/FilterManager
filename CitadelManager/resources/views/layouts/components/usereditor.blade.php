<!-- Include User Record Record Type JS. -->
<script src="{{ asset('js/admin/records/userrecord.js') }}">
</script>

<!-- User Editing Overlay -->
<div class="bg-dark" id="overlay_user_editor">
    <div id="div_08c2_0">
        <div class="flex-grid">

            <h1 id="user_editing_title">Create New User</h1>
            <br />
            <form method="post" action="javascript:void(0)" id="editor_user_form" data-on-submit="submit">
                <div class="tabcontrol" data-role="tabcontrol">
                    <ul class="tabs">
                        <li class="active">
                            <a href="#user_info_tab">User Information</a>
                        </li>
                        <li>
                            <a href="#user_activation_tab">Activations</a>
                        </li>
                        <li>
                            <a href="#self_moderation_tab">User's self-moderation</a>
                        </li>
                    </ul>

                    <div class="frames">
                        <div class="frame" id="user_info_tab">
                            <div class="grid">
                                <h2>
                                    <small>User information</small>
                                </h2>
                                <hr class="thin" />
                                <br>
                                <div class="row cell-auto-size">
                                    <div class="cell cell-auto-size">
                                        <div class="input-control text" data-role="input">
                                            <label for="editor_user_input_user_full_name">User Full Name:</label>
                                            <input type="text" name="editor_user_input_user_full_name" id="editor_user_input_user_full_name">
                                            <button class="button helper-button clear" tabindex="-1" type="button">
                                                <span class="mif-cross"></span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="cell cell-auto-size">
                                        <div class="input-control text" data-role="input">
                                            <label for="editor_user_input_username">User email:</label>
                                            <input type="text" name="editor_user_input_username" id="editor_user_input_username">
                                            <button class="button helper-button clear" tabindex="-1" type="button">
                                                <span class="mif-cross"></span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="cell cell-auto-size">
                                        <div class="input-control text" data-role="input">
                                            <label for="editor_user_input_customer_id">Customer Id:</label>
                                            <input type="number" name="editor_user_input_customer_id" id="editor_user_input_customer_id">
                                            <button class="button helper-button reveal" tabindex="-1" type="button">
                                                <span class="mif-looks"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row cell-auto-size">

                                    <div class="cell cell-auto-size">
                                        <div class="input-control password" data-role="input">
                                            <label for="editor_user_input_password">User password:</label>
                                            <input type="password" name="editor_user_input_password" id="editor_user_input_password">
                                            <button class="button helper-button reveal" tabindex="-1" type="button">
                                                <span class="mif-looks"></span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="cell cell-auto-size">
                                        <div class="input-control password" data-role="input">
                                            <label for="editor_user_input_password_confirm">Password Confirm:</label>
                                            <input type="password" name="editor_user_input_password_confirm" id="editor_user_input_password_confirm">
                                            <button class="button helper-button reveal" tabindex="-1" type="button">
                                                <span class="mif-looks"></span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="cell cell-auto-size">
                                        <div class="input-control text" data-role="input">
                                            <label for="editor_user_input_num_activations">Activations Permitted:</label>
                                            <input type="number" name="editor_user_input_num_activations" id="editor_user_input_num_activations">
                                            <button class="button helper-button clear" type="button">
                                                <span class="mif-cross"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <br/>

                                <div class="row cell-auto-size">
                                    <div class="cell cell-auto-size">
                                        <div class="input-control select" data-role="input">
                                            <label for="editor_user_input_group_id">Group:</label>
                                            <select name="editor_user_input_group_id" id="editor_user_input_group_id">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="cell cell-auto-size">
                                        <div class="input-control select" data-role="input">
                                            <label for="editor_user_input_role_id">Role:</label>
                                            <select name="editor_user_input_role_id" id="editor_user_input_role_id">
                                                @foreach($roles as $role)
                                                <option value="{{ $role->id }}"> {{ $role->display_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="cell">
                                        <label class="option-label" for="editor_user_input_isactive">Enabled:</label>
                                        <label class="switch-original margin-left-add-30">
                                            <input type="checkbox" id="editor_user_input_isactive" name="editor_user_input_isactive">
                                            <span class="check"></span>
                                        </label>
                                        <br />
                                        <br />
                                        <label class="option-label" for="editor_user_report_level">Report Level:</label>
                                        <label class="switch-original margin-left-add-30">
                                            <input type="checkbox" id="editor_user_report_level" name="editor_user_report_level">
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row cell-auto-size" id="div_08c2_2">
                                    <div id="user_form_errors">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="frame" id="user_activation_tab">
                            <div class="grid" id="activation_list">
                                <h2>
                                    <small>User Activations</small>
                                </h2>
                                <hr class="thin" />
                                <table id="user_activation_table" class="table striped hovered border" style="width:100%">

                                </table>
                            </div>
                        </div>

                        <div class="frame" id="self_moderation_tab">
                            <div class="grid" id="self_moderation_list">
                                <h2>
                                    <small>Self-moderation</small>
                                </h2>
                                <hr class="thin" />
                                <table id="self_moderation_table" class="table striped hovered border" style="width: 100%">

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row cell-auto-size">
                        <div class="form-actions">
                            <button id="user_editor_submit" type="submit" class="button primary">Create User</button>
                            <button id="user_editor_cancel" type="button" class="button link">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
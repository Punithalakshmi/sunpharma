
<?=link_tag('frontend/assets/css/jquery.steps.css');?>
<script src="<?=base_url();?>/frontend/assets/js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.js"></script>

<style type="text/css">
/* Adjust the height of section */
#profileForm .content {
    min-height: 100px;
}
#profileForm .content > .body {
    width: 100%;
    height: auto;
    padding: 15px;
    position: relative;
}
</style>


<form id="profileForm" method="post" class="form-horizontal">
    <h2>Account</h2>
    <section data-step="0">
        <div class="form-group">
            <label class="col-xs-3 control-label">Username</label>
            <div class="col-xs-5">
                <input type="text" class="form-control" name="username" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Email</label>
            <div class="col-xs-5">
                <input type="text" class="form-control" name="email" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Password</label>
            <div class="col-xs-5">
                <input type="password" class="form-control" name="password" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Retype password</label>
            <div class="col-xs-5">
                <input type="password" class="form-control" name="confirmPassword" />
            </div>
        </div>
    </section>

    <h2>Profile</h2>
    <section data-step="1">
        <div class="form-group">
            <label class="col-xs-3 control-label">Full name</label>

            <div class="col-xs-4">
                <input type="text" class="form-control" name="firstName" placeholder="First name" />
            </div>

            <div class="col-xs-4">
                <input type="text" class="form-control" name="lastName" placeholder="Last name" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Gender</label>
            <div class="col-xs-6">
                <div class="radio">
                    <label>
                        <input type="radio" name="gender" value="male" /> Male
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="gender" value="female" /> Female
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="gender" value="other" /> Other
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Birthday</label>
            <div class="col-xs-4">
                <input type="text" class="form-control" name="dob" placeholder="YYYY/MM/DD" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Bio</label>
            <div class="col-xs-9">
                <textarea rows="5" class="form-control" name="bio"></textarea>
            </div>
        </div>
    </section>
</form>

<div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Welcome</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Thanks for signing up</p>
            </div>
        </div>
    </div>
</div>

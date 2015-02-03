@extends('_layouts.login')

@section('main')
<div class="account-container">

    <div class="content clearfix">

        <?php echo Form::open(array('url' => 'login/auth', 'method' => 'post')); ?>

        <h1>Member Login</h1>		

        <div class="login-fields">
            
            <p>Masukkan data akun anda...</p>
            
            @if(isset($login_errors))
            <div class="alert alert-error">
                Username/Password salah, periksa kembali.
            </div>
            @endif

            <div class="field">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="" placeholder="Username" class="login username-field" />
            </div> <!-- /field -->

            <div class="field">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field"/>
            </div> <!-- /password -->


        </div> <!-- /login-fields -->

        <div class="login-actions">

            <span class="login-checkbox">
                <input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
                <!--<label class="choice" for="Field">Keep me signed in</label>-->
            </span>

            <button class="button btn btn-success btn-large btn-sign-in"  >Sign In</button>

        </div> <!-- .actions -->

        <?php echo Form::close(); ?>

    </div> <!-- /content -->

</div> <!-- /account-container -->

<!--<div class="span12">
    <div class="login-fields">
    <div  id="jam"></div>
</div>
</div>-->


<!--
<div class="login-extra ">
        <a href="#">Reset Password</a>
</div>  -->

@stop


@section('custom-script')
<script type="text/javascript">
    jQuery(document).ready(function() {
//        //setting jam
//        var options2 = {format: '%A, %d %B %Y [%H:%M:%S]'};
//        var jamLengkap = {format: '<div class="clock light"><p id="jamnya" data-date="%d %B %Y" data-ampm="{{ "TA : " }}" >%H:%M:%S</p></div>'};
//        var jamTok = {format: '%H:%M:%S'};
//        var tanggalTok = {format: '%A, %d %B %Y'};
//        jQuery('#jam').jclock(jamLengkap);

        jQuery('.btn-sign-in').click(function(e) {
            var usrnm = jQuery('input[name=username]').attr('value');
            var pass = jQuery('input[name=password]').attr('value');
            
            if(usrnm == '' || pass == ''){
                alert('Lengkapi data yang kosong.');
                e.preventDefault();
            }
        });
    });
</script>
@stop

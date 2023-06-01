<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"  />

<style>
body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: #030f6b
}

.card {
    border: none;
    border-radius: 25px;
    margin: 20% auto
}

.signup {
    display: flex;
    flex-flow: column;
    justify-content: center;
    padding: 10px 50px
}

a {
    text-decoration: none !important
}

h5 {
    color: #007bff;
    margin-bottom: 3px;
    font-weight: bold
}

small {
    color: #bd081c
}

input {
    width: 100%;
    display: block;
    margin-bottom: 7px
}

.form-control {
    border: 1px solid #030f6b;
    border-radius: 30px;
    background-color: rgba(0, 0, 0, .075);
    letter-spacing: 1px
}

.form-control:focus {
    border: 0.5px solid #dc354575;
    border-radius: 30px;
    box-shadow: none;
    background-color: rgba(0, 0, 0, .075);
    color: #000;
    letter-spacing: 1px
}

.btn {
    display: block;
    width: 100%;
    border-radius: 30px;
    border: none;
	margin-bottom: 2rem!important
    
}

</style>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-12 mx-auto py-4 px-0">
            <div class="card p-0">
                <div class="card-title text-center">
                    <h5 class="mt-5">SIMBG KONVERSI</h5> 
					
					<?php
						echo ($this->session->flashdata('message') != '') ? '<small  class="para">' . $this->session->flashdata('message') . '</small>' : '<small  class="para">Gunakan akun Dinas Perizinan (DPMPTSP)</small>';
					?>
                </div>
                <form action="<?php echo site_url('Converter/Login'); ?>" class="signup form-horizontal" role="form" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none"> 
                    <div class="form-group"><input type="text" class="form-control" name="emaillogin"  pattern="[a-zA-Z0-9'.@'\s]*" required placeholder="email / username *"></div>
                    <div class="form-group"><input type="password" class="form-control" name="passwordnya" autocomplete="off" pattern="[a-zA-Z0-9'@'\s]*" required placeholder="kata sandi *"></div>
					<button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>

</script>
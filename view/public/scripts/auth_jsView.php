<script>
    var base_url = '<?= base_url ?>';

    function login_form() {
    
        //$('#pleaseWaitDialog').modal('show'); // show loading
        //$('#modal-login').css('z-index',50);
       // $('#btnlogin').text('Verificando...'); //change button text
        $('#btnlogin').attr('disabled', true); //set button disable 
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        var url = "<?= $this->url("auth", "login_singin"); ?>";
        $.ajax({
            url: url,
            type: "POST",
            data: $('#login-form').serialize(),
            dataType: 'JSON',
            success: function(data) {
                if (data.logged_in == true) {
                    $('#modal-login').css('z-index', 50);
                    //alert('Su Sesión fue inicada correctamente');
                    window.location.replace(base_url);
                } else if (data.logged_in == false) {
                    $('#modal-login').css('z-index', 50);
                    alert('Su usuario se encuentra inactivo');
                    window.location.replace('<?= $this->url("auth", "send_again"); ?>');
                } else {
                    if (data.status == true) {
                        if (data.profiles == true) {
                            $.post('<?= $this->url("auth", "get_profiles_by_id_users"); ?>',
                                function(prof) {
                                    $('#get_profile').html(prof);
                                });
                            $('#modal-profiles').modal('show');
                        } else {
                            //alert('Su Sesión fue inicada correctamente');
                            window.location.replace(base_url);
                        }
                    } else {
                        if (data.show_captcha == true) {
                            $.post('<?= $this->url("auth", "ajax_create_recaptcha"); ?>',
                                function(show) {
                                    $('#show_captcha').html(show);
                                });
                            $('#btnlogin').attr('disabled', true).css('display', 'none'); //set button enable  
                        } else {
                            $('#btnlogin').attr('disabled', false);
                        }

                        for (var i = 0; i < data.inputerror.length; i++) {
                            $('[name="' + data.inputerror[i] + '"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                            $('[name="' + data.inputerror[i] + '"]').next().next().text(data.error_string[i]); //select span help-block class set text error string      
                        }

                        if (data.inputerror == 'banned') {
                            alert('Este usuario se Encuentra Inactivo');
                        }
                        $('#modal-login').css('z-index', 1050);
                        $('#pleaseWaitDialog').modal('hide'); // show bootstrap modal
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                //alert('Error al Iniciar Sesión');
                $('#btnlogin').text('Sign in!'); //change button text
                $('#btnlogin').attr('disabled', false); //set button enable          
                //$("#pleaseWaitDialog").modal({backdrop: false});
                $('#modal-login').css('z-index', 1050);
                $('#pleaseWaitDialog').modal('hide'); // show bootstrap modal
                ALERT("error!");
            }
        });
    } //end login form
</script>
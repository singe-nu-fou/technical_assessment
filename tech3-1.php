<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
        <style>
            .row > div{
                padding-top:15px;
            }
        </style>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#contactForm').submit(function(event){
                    event.preventDefault();
                    contactSubmit();
                });
            });
            
            function contactSubmit(){
                var dataObj = [];
                
                $.ajax({
                    type:'POST',
                    url:'tech3-2.php',
                    beforeSend:function(xhr,opts){
                        $.each($('#contactForm').serializeArray(),function(_,keyVal){
                            if($.trim(keyVal.value) === ''){
                                alert('Please complete the form in full to continue!');
                                xhr.abort();
                                return false;
                            }
                            console.log(keyVal.name);
                            switch(keyVal.name){
                                case 'PRE':
                                case 'N1':
                                case 'N2':
                                case 'zip':
                                case 'budget':
                                    if(keyVal.value % 1 !== 0){
                                        alert('Please ensure your phone, zip or budget are proper values!');
                                        xhr.abort();
                                        return false;
                                    }
                                    break;
                                    break;
                            }
                            
                            dataObj[keyVal.name] = keyVal.value;
                        });
                    },
                    data:{dataObj:JSON.stringify($('#contactForm').serializeArray())},
                    complete:function(response){
                        alert(response.responseText);
                        $('input').val('');
                    }
                });
            }
        </script>
    </head>
    <body>
        <div class="col-lg-4 col-lg-offset-4">
            <form id="contactForm" method="POST">
                <div class="row">
                    <div class="col-lg-6">
                        First Name<input type="text" name="firstName" class="form-control">
                    </div>
                    <div class="col-lg-6">
                        Last Name<input type="text" name="lastName" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        Address 1<input type="text" name="address1" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        Address 2<input type="text" name="address2" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        City<input type="text" name="city" class="form-control">
                    </div>
                    <div class="col-lg-3">
                        State<input type="text" name="state" maxlength="2" class="form-control">
                    </div>
                    <div class="col-lg-3">
                        Zip<input type="text" name="zip" maxlength="5" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        Phone<input type="text" name="PRE" maxlength="3" class="form-control">
                    </div>
                    <div class="col-lg-2">
                        &nbsp;<input type="text" name="N1" maxlength="3" class="form-control">
                    </div>
                    <div class="col-lg-3">
                        &nbsp;<input type="text" name="N2" maxlength="4" class="form-control">
                    </div>
                    <div class="col-lg-5">
                        Budget
                        <div class="input-group">
                            <div class="input-group-addon">$</div>
                            <input type="text" name="budget" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        How did you find out about us?
                        <select class="form-control" name="option">
                            <option>Internet</option>
                            <option>TV</option>
                            <option>Friend</option>
                            <option>Employee</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        Contact Us At: XXX-XXX-XXXX For Assistance<button type="submit" class="btn btn-success pull-right">Contact Us!</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
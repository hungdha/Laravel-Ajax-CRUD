$(document).ready(function(){

    var url = "/users";

    //display modal form for task editing
    $('.open-modal').click(function(){
        var user_id = $(this).val();

        $.get(url + '/' + user_id, function (data) {
            //success data
            console.log(data);
            $('#user_id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#btn-save').val("update");
            $('#myModal').modal('show');
        }) 
    });

    //display modal form for creating new task
    $('#btn-add').click(function(){
        $('#btn-save').val("add");
        $('#frmUsers').trigger("reset");
        $('#myModal').modal('show');
    });

    //delete task and remove it from list
    $('.delete-user').click(function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        e.preventDefault();

        var user_id = $(this).val();

        $.ajax({

            type: "DELETE",
            url: url + '/' + user_id,
            success: function (data) {
                console.log(data);

                $("#user" + user_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //create new user / update existing user
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });        
        e.preventDefault(); 

        var formData = {
            name: $('#name').val(),
            email: $('#email').val(),
            password: $('#password').val()
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();

        var type = "POST"; //for creating new resource
        var user_id = $('#user_id').val();
        var my_url = url;

        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + user_id;
        }

        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log('Success');
                console.log(data);
                // save ok
                if( data.id !== undefined ){
                    var user = '<tr id="task' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.email + '</td><td>' + data.created_at + '</td>';
                    user += '<td><button class="btn btn-warning btn-xs btn-detail open-modal" value="' + data.id + '">Edit</button>';
                    user += '<button class="btn btn-danger btn-xs btn-delete delete-task" value="' + data.id + '">Delete</button></td></tr>';

                    if (state == "add"){ //if user added a new record
                        $('#users-list').append(user);
                    }else{ //if user updated an existing record

                        $("#user" + user_id).replaceWith( user );
                    }

                    $('#frmUsers').trigger("reset");

                    $('#myModal').modal('hide');
                }else{
                    
                }
            },
            error: function (data) {
                console.log('Error:', data);
                if( data.status === 422 ){
                    // Validate errors
                    $.each(data.responseJSON, function(i, val) {
                      console.log(i) ; 
                      $("#" + i).parents('.form-group').addClass('has-error');
                    });
                }
                if( data.status ===  500 ){
                    alert('500 Internal Server Error');
                }
            }
        });
    }); //  end save

    // on change key
    $("#frmUsers").keyup(function(e){
        var field = $(e.target);
        if(field.val() == "" ){
            $("#" + field.attr('id') ).parents('.form-group').addClass('has-error');
        }else{
            $("#" + field.attr('id') ).parents('.form-group').removeClass('has-error');
        }      
    });
});
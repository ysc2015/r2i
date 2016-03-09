/**
 * Created by PhpStorm.
 * User: RR
 */

function formhash(form, password, bk_str) {
    //clear error text
    $('#responseError').html('');
    // Create a new element input, this will be our hashed password field.
    var p = document.createElement("input");

    // Add the new element to our form.
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    // Make sure the plaintext password doesn't get sent.
    password.value = "";
    // Finally submit the form.
    //form.submit();
    var formData = {};
    $(form).find("input[name]").each(function (index, node) {
        formData[node.name] = node.value;
    });
    console.log(formData);

    //send login ajax request
    $.ajax({
        url: bk_str+'public/api/loginProcess.php',
        type: 'POST',
        dataType: 'json',
        data: {email : formData.email, p : formData.p},
        success: function (response) {
            console.log('success');
            console.log(response);
            if(response.status == 'error')
                $('#responseError').html(response.msg)
            else if(response.status == 'success') window.location.replace('index.php');
                },
        error: function (response) {
            console.log('error');
            console.log(response);
        }
    });

}

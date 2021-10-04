$(".deleteField").click(function(){
    const id = $(this).data("id");
    const token = $(this).data("token");
    const user_id = $(this).data("user_id");
    $.ajax({
        url: "/field/"+id,
        type: 'DELETE',
        dataType: "JSON",
        data: {
            "id": id,
            "_method": 'DELETE',
            "_token": token,
            "user_id": user_id
        },
        success: () =>  {
            $(this).closest(".field-item").remove();
        }
    });

    console.log("error");
});
$(".statusFilter").change(function () {
    const filter = $(this).val();
    $.ajax({
        url: "/user",
        type: 'GET',
        data: {
            "filter": filter,
            //"_token": token,
        },
        success: () =>  {
            window.location.reload();
        }
    });
});

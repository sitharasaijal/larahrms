function alert_message_modal(
    type = "",
    message = "",
    tagname = "AlertMessageModal"
) {
    var html = "";
    html = html + ' <div class="alert ' + type + '" role="alert">';
    html =
        html +
        ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="login_message">' +
        message +
        " </span>";
    html = html + " </div>";
    $(tagname).html(html);
    setTimeout(function () {
        $(tagname).empty();
    }, 5000);
}

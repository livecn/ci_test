/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(function () {

    "use strict";

    $('#chat-box').slimScroll({
        height: '250px'
    });

    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();

    //The Calender
    $("#calendar").datepicker();
});

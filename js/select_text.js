// http://stackoverflow.com/questions/1173194/select-all-div-text-with-single-mouse-click
// Licensed under cc by-sa 3.0
// Author: Dominic https://stackoverflow.com/users/414062/dominic

    function selectText(containerid) {
        if (document.selection) {
            var range = document.body.createTextRange();
            range.moveToElementText(document.getElementById(containerid));
            range.select();
        } else if (window.getSelection) {
            var range = document.createRange();
            range.selectNode(document.getElementById(containerid));
            window.getSelection().removeAllRanges(range);
            window.getSelection().addRange(range);
        }
    }
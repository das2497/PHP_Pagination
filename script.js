function search() {

    // alert("ok");

    var sb = document.getElementById("sbar").value;
    var sc = document.getElementById("sc").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (this.readyState == 4) {
            var t = r.responseText;

            // alert(t);

            document.getElementById("tb").innerHTML = t;

        }
    }

    var f = new FormData();
    switch (sb) {
        case "":
            switch (sc) {
                case "0":

                    break;

                default:
                    f.append("sc", sc);
                    break;
            }

            break;

        default:
            switch (sc) {
                case "0":
                    f.append("sb", sb);
                    break;

                default:
                    f.append("sb", sb);
                    f.append("sc", sc);
                    break;
            }

            break;
    }



    r.open("POST", "process.php", true);
    r.send(f);

}

function dwnld() {
    var sb = document.getElementById("sbar").value;
    var sc = document.getElementById("sc").value;
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (this.readyState == 4) {
            var t = r.responseText;

            alert(t);


        }
    }
    var f = new FormData();
    switch (sb) {
        case "":
            switch (sc) {
                case "0":

                    break;

                default:
                    f.append("sc", sc);
                    break;
            }

            break;

        default:
            switch (sc) {
                case "0":
                    f.append("sb", sb);
                    break;

                default:
                    f.append("sb", sb);
                    f.append("sc", sc);
                    break;
            }

            break;
    }
    r.open("POST", "ecell.php", true);
    r.send(f);

}

//================================================================================================

function load(x) {

    // alert(x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            // alert(text);
            document.getElementById("tb").innerHTML = text;

        }
    }

    r.open("GET", "process.php?x=" + x, true);
    // r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    r.send();

}
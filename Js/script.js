function setDimensions() {

    const deviceHeight = window.innerHeight;
    // converting vw to px, same as just using document.getElementById
    const headerHeight = (17 / 100) * window.innerWidth;
    const bottomNavHeight = 50;


    // for profile
    var profileTop = document.getElementById('topHeight');
    var profileTarget = document.getElementsByClassName('cmTargets');

    if (profileTop != null && profileTop != undefined) {
        var totalUsedHeight = profileTop.clientHeight + bottomNavHeight + headerHeight;
        // the + 5 is just for any tiny error
        var availableHeight = deviceHeight - totalUsedHeight + 5;

        for (let index = 0; index < profileTarget.length; index++) {
            const element = profileTarget[index];
            element.style.minHeight = availableHeight + 'px';
        }

    }

    // for album
    var albumTop = document.getElementById('aTop');
    var albumTarget = document.getElementById('fakeSubMenu');

    if (albumTarget != null && albumTarget != undefined) {
        var totalUsedHeight = albumTop.clientHeight + bottomNavHeight + headerHeight;
        var availableHeight = deviceHeight - totalUsedHeight + 5;

        albumTarget.style.minHeight = availableHeight + 'px';
    }


    // for search
    var searchTarget = document.getElementById('searchTarget');
    var extra = document.getElementsByClassName('srb');

    if (searchTarget != null && searchTarget != undefined) {
        var totalUsedHeight = bottomNavHeight + headerHeight;
        var availableHeight = deviceHeight - totalUsedHeight + 5;

        searchTarget.style.minHeight = availableHeight + 'px';

        for (let index = 0; index < extra.length; index++) {
            const element = extra[index];
            element.style.height = availableHeight + 'px';
        }

    }

    // for asbo
    var asboTarget = document.getElementById('asboTarget');
    var asboTop = document.getElementById('asboTop');
    var extra = document.getElementsByClassName('extra');

    if (asboTarget != null && asboTarget != undefined) {
        // + 36 is an extra height on the nav of that page
        var totalUsedHeight = bottomNavHeight + headerHeight + asboTop.clientHeight + 36;
        var availableHeight = deviceHeight - totalUsedHeight;

        asboTarget.style.minHeight = availableHeight + 'px';

        for (let index = 0; index < extra.length; index++) {
            const element = extra[index];
            element.style.minHeight = availableHeight + 'px';
        }

    }


    // for playlist
    var playlistbody = document.getElementById('playCon');

    if (playlistbody != null && playlistbody != undefined) {
        var totalUsedHeight = bottomNavHeight + headerHeight;
        var availableHeight = deviceHeight - totalUsedHeight;

        playlistbody.style.minHeight = availableHeight + 'px';

    }

    // for register page
    var registerForm = document.getElementById('regBody');
    if (registerForm != null && registerForm != undefined) {
        var footerHeight = 105.550; // in reality its actually a fit content
        var totalUsedHeight = footerHeight + headerHeight;
        var availableHeight = deviceHeight - totalUsedHeight;

        registerForm.style.minHeight = availableHeight + 'px';

    }

    window.onresize = setDimensions;

}

window.onload = setDimensions();

function nav() {
    var x = document.getElementById('header');
    var y = document.getElementById('drop');
    var z = document.getElementById('icon')

    if (x.classList.contains('header')) {
        x.classList.remove('header');
        x.classList.add('header2');
        y.classList.remove('hide');
        y.classList.add('show');
        z.classList.remove('fa-bars');
        z.classList.add('fa-times');
    } else {
        x.classList.remove('header2');
        x.classList.add('header');
        y.classList.remove('show');
        y.classList.add('hide');
        z.classList.remove('fa-times');
        z.classList.add('fa-bars');
    }
}

function flag() {
    var flag = document.getElementsByClassName('flagicon');
    var cName = document.getElementsByClassName('countryName');
    var div = document.getElementsByClassName('nationality');

    for (let index = 0; index < div.length; index++) {
        const element = div[index];
        element.classList.add('hide');
    }

    var request = new XMLHttpRequest();
    request.open('GET', 'https://api.ipdata.co/?api-key=444a9f4227a2fff739b29e11ad6840c281afca169e3b5d9851df2f88', true);
    request.setRequestHeader('Accept', 'application/json');
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;
            var jsonObj = JSON.parse(response);
            for (let index = 0; index < flag.length; index++) {
                const element = flag[index];
                element.src = jsonObj.flag;
            }
            for (let index = 0; index < cName.length; index++) {
                const element = cName[index];
                element.innerHTML = jsonObj.country_name;
            }
            for (let index = 0; index < div.length; index++) {
                const element = div[index];
                element.classList.remove('hide');
            }

        }
    };

    request.send();
}
flag()

function themes() {
    var x = document.getElementById('themesangle');
    var y = document.getElementById('opt');

    if (x.classList.contains('fa-angle-right')) {
        x.classList.remove('fa-angle-right');
        x.classList.add('fa-angle-down');
        y.classList.remove('hide');
        y.classList.add('opt');
    } else {
        x.classList.remove('fa-angle-down');
        x.classList.add('fa-angle-right');
        y.classList.remove('opt');
        y.classList.add('hide');
    }
}

function hot() {
    var x = document.getElementById('hotangle');
    var y = document.getElementById('hotopt');

    if (x.classList.contains('fa-angle-right')) {
        x.classList.remove('fa-angle-right');
        x.classList.add('fa-angle-down');
        y.classList.remove('hide');
        y.classList.add('hotopt');
    } else {
        x.classList.remove('fa-angle-down');
        x.classList.add('fa-angle-right');
        y.classList.remove('hotopt');
        y.classList.add('hide');
    }
}

function topsec() {
    var x = document.getElementById('topangle');
    var y = document.getElementById('topopt');

    if (x.classList.contains('fa-angle-right')) {
        x.classList.remove('fa-angle-right');
        x.classList.add('fa-angle-down');
        y.classList.remove('hide');
        y.classList.add('topopt');
    } else {
        x.classList.remove('fa-angle-down');
        x.classList.add('fa-angle-right');
        y.classList.remove('topopt');
        y.classList.add('hide');
    }
}

function manage() {
    var x = document.getElementById('accountangle');
    var y = document.getElementById('accountopt');

    if (x.classList.contains('fa-angle-right')) {
        x.classList.remove('fa-angle-right');
        x.classList.add('fa-angle-down');
        y.classList.remove('hide');
        y.classList.add('accountopt');
    } else {
        x.classList.remove('fa-angle-down');
        x.classList.add('fa-angle-right');
        y.classList.remove('accountopt');
        y.classList.add('hide');
    }
}

function set() {
    var d = document.getElementById('set');
    var nav = document.getElementById('settingsNav');
    var navContent = document.getElementById('sNMain');
    var navHeader = document.getElementById('sNFirst');
    var body = document.getElementsByTagName('BODY')[0];

    if (d.classList.contains('setbior')) {
        body.style.overflow = 'scroll';
        d.classList.remove('setbior');
        d.classList.add('setbicr');
        nav.style.width = '0%';
        navHeader.classList.add('hide');
        navContent.classList.add("hide");
    } else {
        body.style.overflow = 'hidden';
        d.classList.remove('setbicr');
        d.classList.add('setbior');
        nav.style.width = '90%';
        setTimeout(() => {
            navHeader.classList.remove('hide');
            setTimeout(() => {
                navContent.classList.remove("hide");
            }, 50);
        }, 400);
    }

    if (navContent.classList.contains("hide") == false || navHeader.classList.contains("hide") == false) {
        navHeader.classList.add('hide');
        navContent.classList.add("hide");
    }

}

function dropOptSN(x) {

    var angle = document.getElementById('sortAngle' + x);
    var subMenu = document.getElementById('sNOsub' + x);

    if (subMenu.classList.contains('hide')) {
        subMenu.classList.remove('hide');
        angle.classList.remove('fa-angle-right');
        angle.classList.add('fa-angle-down');
    } else {
        subMenu.classList.add('hide');
        angle.classList.remove('fa-angle-down');
        angle.classList.add('fa-angle-right');
    }

}

function ssec(x) {

    var a = document.getElementById('uedfull');
    var b = document.getElementById('pedfull');
    var c = document.getElementById('nedfull');
    var d = document.getElementById('rD');

    if (x == 'up') {
        a.classList.remove('hide');
        d.classList.remove('red_dot_adv');
        b.classList.add('hide');
        c.classList.add('hide');
    } else if (x == 'plist') {
        b.classList.remove('hide');
        d.classList.remove('red_dot_adv');
        a.classList.add('hide');
        c.classList.add('hide');
    } else if (x == 'not') {
        c.classList.remove('hide');
        d.classList.add('red_dot_adv');
        b.classList.add('hide');
        a.classList.add('hide');
    } else {
        a.classList.remove('hide');
        d.classList.remove('red_dot_adv');
        b.classList.add('hide');
        c.classList.add('hide');
    }

}

function setselect(x) {

    var a = document.getElementById('upi');
    var b = document.getElementById('ppi');
    var c = document.getElementById('npi');

    if (x == 'up') {
        a.classList.add('select');
        b.classList.remove('select');
        c.classList.remove('select');
    } else if (x == 'plist') {
        b.classList.add('select');
        a.classList.remove('select');
        c.classList.remove('select');
    } else if (x == 'not') {
        c.classList.add('select');
        b.classList.remove('select');
        a.classList.remove('select');
    } else {
        a.classList.add('select');
        b.classList.remove('select');
        c.classList.remove('select');
    }

}

function ssecp(x) {
    var a = document.getElementById('ued');
    var b = document.getElementById('ped');

    if (x == 'unp') {
        a.classList.remove('hide');
        b.classList.add('hide');
    } else if (x == 'ppn') {
        b.classList.remove('hide');
        a.classList.add('hide');
    } else {
        a.classList.remove('hide');
        b.classList.add('hide');
    }
}

function setselectp(x) {
    var a = document.getElementById('upi');
    var b = document.getElementById('ppi');

    if (x == 'unp') {
        a.classList.add('select');
        b.classList.remove('select');
    } else if (x == 'ppn') {
        b.classList.add('select');
        a.classList.remove('select');
    } else {
        a.classList.add('select');
        b.classList.remove('select');
    }
}

function se(x) {
    var a = document.getElementById('stop');
    var b = document.getElementById('sson');
    var c = document.getElementById('salb');
    var d = document.getElementById('speo');

    var e = document.getElementById('srbtop');
    var f = document.getElementById('srbson');
    var g = document.getElementById('srbalb');
    var h = document.getElementById('srbpeo');

    if (x == 'top') {
        a.classList.add('se');
        b.classList.remove('se');
        c.classList.remove('se');
        d.classList.remove('se');

        e.classList.remove('hide');
        f.classList.add('hide');
        g.classList.add('hide');
        h.classList.add('hide');
    } else if (x == 'song') {
        b.classList.add('se');
        a.classList.remove('se');
        c.classList.remove('se');
        d.classList.remove('se');

        f.classList.remove('hide');
        e.classList.add('hide');
        g.classList.add('hide');
        h.classList.add('hide');
    } else if (x == 'album') {
        c.classList.add('se');
        b.classList.remove('se');
        a.classList.remove('se');
        d.classList.remove('se');

        g.classList.remove('hide');
        f.classList.add('hide');
        e.classList.add('hide');
        h.classList.add('hide');
    } else if (x == 'people') {
        d.classList.add('se');
        b.classList.remove('se');
        c.classList.remove('se');
        a.classList.remove('se');

        h.classList.remove('hide');
        f.classList.add('hide');
        g.classList.add('hide');
        e.classList.add('hide');
    } else {
        a.classList.add('se');
        b.classList.remove('se');
        c.classList.remove('se');
        d.classList.remove('se');

        e.classList.remove('hide');
        f.classList.add('hide');
        g.classList.add('hide');
        h.classList.add('hide');
    }

}

function eye(x) {
    var a = document.getElementById('pass');
    var b = document.getElementById('con');
    var d = document.getElementById('eye1');
    var c = document.getElementById('eye2');

    if (x == '1' & c.classList.contains('fa-eye')) {
        a.type = 'text';
        c.classList.remove('fa-eye');
        c.classList.add('fa-eye-slash');
    } else if (x == '1' & c.classList.contains('fa-eye-slash')) {
        a.type = 'password';
        c.classList.add('fa-eye');
        c.classList.remove('fa-eye-slash');
    } else if (x == '2' & d.classList.contains('fa-eye')) {
        b.type = 'text';
        d.classList.remove('fa-eye');
        d.classList.add('fa-eye-slash');
    } else if (x == '2' & d.classList.contains('fa-eye-slash')) {
        b.type = 'password';
        d.classList.add('fa-eye');
        d.classList.remove('fa-eye-slash');
    }

}

function form_validate() {

    return empty_validate()

}


function empty_validate() {

    var a = document.forms['regform']['first'].value;
    var b = document.forms['regform']['last'].value;
    var c = document.forms['regform']['email'].value;
    var d = document.forms['regform']['username'].value;
    var i = document.getElementById('formerror');

    i.classList.remove("hide")

    var a = a.trim()
    var b = b.trim()
    var c = c.trim()
    var d = d.trim()

    if (a == "" && b != "" && c != "" && d != "") {
        i.innerHTML = "Please fill in the field for first name";
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else if (b == "" && a != "" && c != "" && d != "") {
        i.innerHTML = "Please fill in the field for last name";
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else if (c == "" && b != "" && a != "" && d != "") {
        i.innerHTML = "Please fill in the field for email";
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else if (d == "" && b != "" && c != "" && a != "") {
        i.innerHTML = "Please fill in the field for username";
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else if (a != "" && b != "" && c != "" && d != "") {

        return length_validate()

    } else {
        i.innerHTML = "Please fill in the fields below";
        i.classList.add('formerrorani');

        error_remove()
        return false
    }

}


function length_validate() {

    var a = document.forms['regform']['first'].value;
    var b = document.forms['regform']['last'].value;
    var c = document.forms['regform']['email'].value;
    var d = document.forms['regform']['username'].value;
    var i = document.getElementById('formerror');

    var a = a.length
    var b = b.length
    var c = c.length
    var d = d.length

    var len = 3;

    if (a < len && b >= len && c >= len && d >= len) {
        i.innerHTML = "First Name field less than 3 characters";
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else if (b < len && a >= len && c >= len && d >= len) {
        i.innerHTML = "Last Name field less than 3 characters";
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else if (c < len && b >= len && a >= len && d >= len) {
        i.innerHTML = "Email field less than 3 characters";
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else if (d < len && b >= len && c >= len && a >= len) {
        i.innerHTML = "Username field less than 3 characters";
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else if (a >= len && b >= len && c >= len && d >= len) {

        return pass_validate()

    } else {
        i.innerHTML = "Sorry field value too short";
        i.classList.add('formerrorani');

        error_remove()
        return false
    }

}


function pass_validate() {

    var a = document.forms["regform"]["pass"].value;
    var b = document.forms["regform"]["con"].value;
    var c = document.forms["regform"]["email"].value;
    var i = document.getElementById("formerror");

    var alen = a.length;
    var blen = b.length;
    var minlen = 8;
    var maxlength = 16;

    var strengthRegex = /([A-z][0-9])/gi;

    var estrengthRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (a != b) {
        i.innerHTML = "Password mismatch error.";
        i.classList.add("formerrorani");

        error_remove()
        return false
    } else if (alen < minlen || alen > maxlength || blen < minlen || blen > maxlength) {
        i.innerHTML = "Password must be between 8 - 16 charcters";
        i.classList.add("formerrorani");
        i.classList.add("lngtextfont");

        error_remove()
        return false
    } else if (!a.match(strengthRegex)) {
        i.innerHTML = "Password must include numbers and letters";
        i.classList.add("formerrorani");
        i.classList.add("lngtextfont");

        error_remove()
        return false
    } else if (!c.match(estrengthRegex)) {
        i.innerHTML = "Invalid email";
        i.classList.add("formerrorani");
        i.classList.add("lngtextfont");

        error_remove()
        return false
    } else {

        return gen_validate()

    }
}

function gen_validate() {

    var a = document.forms['regform']['gender'].value;
    var b = document.forms['regform']['checkb'].value;
    var i = document.getElementById('formerror');

    if (a == "") {
        i.innerHTML = "Please pick a gender";
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else if (b == "") {
        i.innerHTML = "Please tick the agreement box";
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else {

        return true

    }

}

function setDate() {

    var elem = document.getElementById('dateJs');

    elem.value = Date.now();

}

function error_remove() {
    var i = document.getElementById('formerror');

    setTimeout(
        function main() {
            i.classList.remove('formerrorani');
            i.classList.remove('formsuccess');
            i.classList.remove("lngtextfont")
            i.innerHTML = "";
            i.classList.add("hide");
        },
        3000
    )

}


function log_validate() {

    var a = document.forms['logForm']['username'].value;
    var b = document.forms['logForm']['password'].value;
    var i = document.getElementById('formerror');

    i.classList.remove("hide");

    if (a == "" || b == "") {
        i.innerHTML = "Sorry, fields cannot be empty";
        i.classList.add('formerrorani');

        error_remove();
        return false
    } else {
        return true
    }

}

function e(x) {

    var a = document.getElementById(x);

    a.classList.remove('hide');

}

function x(x) {

    var a = document.getElementById(x);

    a.classList.add('hide');

}

function cpremovefun(x) {

    var a = document.getElementById('removespan');

    a.classList.remove('erpti');
    a.classList.remove('material-icons-round');
    a.innerHTML = '';
    a.classList.add('preloader_circle');

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            preloader_remove();
            document.getElementById("cpsrc").src = this.responseText;
        }
    };

    xhttp.open("GET", "process/removecp?id=" + x, true);
    xhttp.send();

}

function preloader_remove() {
    var a = document.getElementById('removespan');

    a.classList.add('erptid');
    a.classList.add('material-icons-round');
    a.innerHTML = 'done';
    a.classList.remove('preloader_circle');

    setTimeout(
        function done() {

            a.classList.remove('erptid');
            a.classList.add('erpti');
            a.innerHTML = 'delete';

        }
        , 2000
    )

}


function uploadpic(x) {

    var a = document.getElementById('cpeditspan');

    a.classList.remove('erpti');
    a.classList.remove('material-icons-round');
    a.innerHTML = '';
    a.classList.add('preloader_circle');

    var id = x;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            var pattern = /Upload[/]Img[/]Profile[/]Cover[/]/;
            var response = this.responseText;
            var check = response;

            if (check.match(pattern)) {
                cpremove_loader_done()
                document.getElementById("cpsrc").src = response;
            } else {
                cpremove_loader_failed()
                document.getElementById("customerror").classList.remove('hide');
                document.getElementById("customerror").classList.add('ceani');
                document.getElementById("customerror").classList.add('customerror');
                document.getElementById("customerror").innerHTML = response;
            }
        }
    };

    xhttp.open("POST", "process/changecp?id=" + id, true);
    var a = document.getElementById('pchangeform');
    var data = new FormData(a)
    xhttp.send(data);

    // this empties the value field
    var fileInput = document.getElementById('epic');
    fileInput.value = '';

}


function cpremove_loader_done() {
    var a = document.getElementById('cpeditspan');

    a.classList.add('erptid');
    a.classList.add('material-icons-round');
    a.innerHTML = 'done';
    a.classList.remove('preloader_circle');

    setTimeout(
        function done() {

            a.classList.remove('erptid');
            a.classList.add('erpti');
            a.innerHTML = 'edit';

        }
        , 2000
    )

}

function cpremove_loader_failed() {
    var a = document.getElementById('cpeditspan');
    var b = document.getElementById('customerror');

    a.classList.add('erptid');
    a.classList.add('material-icons-round');
    a.innerHTML = 'clear';
    a.classList.remove('preloader_circle');

    setTimeout(
        function done() {

            a.classList.remove('erptid');
            a.classList.add('erpti');
            a.innerHTML = 'edit';

            b.classList.add('hide');
            b.innerHTML = '';
            b.classList.remove('ceani');
            b.classList.remove('customerror');

        }
        , 2000
    )

}


function dpremovefun(x) {

    var a = document.getElementById('dpremovespan');

    a.classList.remove('erpti');
    a.classList.remove('material-icons-round');
    a.innerHTML = '';
    a.classList.add('preloader_circle');

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            dppreloader_remove();
            document.getElementById("ppsrc").src = this.responseText;
            document.getElementById("bpimg").src = this.responseText;
        }
    };

    xhttp.open("GET", "process/removedp?id=" + x, true);
    xhttp.send();
}

function dppreloader_remove() {
    var a = document.getElementById('dpremovespan');

    a.classList.add('erptid');
    a.classList.add('material-icons-round');
    a.innerHTML = 'done';
    a.classList.remove('preloader_circle');

    setTimeout(
        function done() {

            a.classList.remove('erptid');
            a.classList.add('erpti');
            a.innerHTML = 'delete';

        }
        , 2000
    )

}

function uploaddpic(x) {

    var a = document.getElementById('dpeditspan');

    a.classList.remove('erpti');
    a.classList.remove('material-icons-round');
    a.innerHTML = '';
    a.classList.add('preloader_circle');

    var id = x;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            var pattern = /Upload[/]Img[/]Profile[/]Picture[/]/;
            var response = this.responseText;
            var check = response;

            if (check.match(pattern)) {
                dpremove_loader_done();
                document.getElementById("ppsrc").src = response;
                document.getElementById("bpimg").src = response;
            } else {
                dpremove_loader_failed()
                document.getElementById("customerror").classList.remove('hide');
                document.getElementById("customerror").classList.add('ceani');
                document.getElementById("customerror").classList.add('customerror');
                document.getElementById("customerror").innerHTML = response;
            }
        }
    };

    xhttp.open("POST", "process/changedp?id=" + id, true);
    var a = document.getElementById('dpchangeform');
    var data = new FormData(a)
    xhttp.send(data);

    // this empties the value field
    var fileInput = document.getElementById('edpic');
    fileInput.value = '';

}

function dpremove_loader_done() {
    var a = document.getElementById('dpeditspan');

    a.classList.add('erptid');
    a.classList.add('material-icons-round');
    a.innerHTML = 'done';
    a.classList.remove('preloader_circle');

    setTimeout(
        function done() {

            a.classList.remove('erptid');
            a.classList.add('erpti');
            a.innerHTML = 'edit';

        }
        , 2000
    )

}

function dpremove_loader_failed() {
    var a = document.getElementById('dpeditspan');
    var b = document.getElementById('customerror');

    a.classList.add('erptid');
    a.classList.add('material-icons-round');
    a.innerHTML = 'clear';
    a.classList.remove('preloader_circle');

    setTimeout(
        function done() {

            a.classList.remove('erptid');
            a.classList.add('erpti');
            a.innerHTML = 'edit';

            b.classList.add('hide');
            b.innerHTML = '';
            b.classList.remove('ceani');
            b.classList.remove('customerror');

        }
        , 2000
    )

}

function search() {

    var searchBox = document.getElementById('search');
    var form = document.getElementById('searchform');
    var pendingText = document.getElementsByClassName('zerosearch');

    function loader(searchText, element) {
        element = element;
        setInterval(() => {

            element.innerHTML = "Searching for '" + searchText + "'";

            setTimeout(() => {
                element.innerHTML = "Searching for '" + searchText + "'.";

                setTimeout(() => {
                    element.innerHTML = "Searching for '" + searchText + "'..";

                    setTimeout(() => {
                        element.innerHTML = "Searching for '" + searchText + "'...";
                    }, 350);

                }, 350);

            }, 350);

        }, 1200);
    }

    if (searchBox != null && searchBox != undefined) {

        searchBox.addEventListener('keyup', () => {

            var searchText = searchBox.value;

            if (searchText.length > 0) {
                for (let index = 0; index < pendingText.length; index++) {
                    const element = pendingText[index];
                    loader(searchText, element)
                }
            }

            sendsearchtop('top');
            sendsearchpeo('people');
            sendsearchson('songs');
            sendsearchalb('album');

        });

        form.addEventListener('submit', (x) => {
            x.preventDefault();
        });
    }

}

search()

function sendsearchtop(x) {

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("srbtop").innerHTML = this.responseText;
        }
    };

    xhttp.open("POST", "process/searchprocess?part=" + x, true);
    var a = document.getElementById('searchform');
    var data = new FormData(a)
    xhttp.send(data);

}

function sendsearchpeo(x) {

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("srbpeo").innerHTML = this.responseText;
        }
    };

    xhttp.open("POST", "process/searchprocess?part=" + x, true);
    var a = document.getElementById('searchform');
    var data = new FormData(a)
    xhttp.send(data);

}

function sendsearchson(x) {

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("srbson").innerHTML = this.responseText;
        }
    };

    xhttp.open("POST", "process/searchprocess?part=" + x, true);
    var a = document.getElementById('searchform');
    var data = new FormData(a)
    xhttp.send(data);

}

function sendsearchalb(x) {

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("srbalb").innerHTML = this.responseText;
        }
    };

    xhttp.open("POST", "process/searchprocess?part=" + x, true);
    var a = document.getElementById('searchform');
    var data = new FormData(a)
    xhttp.send(data);

}


function showaddbody() {
    var a = document.getElementById('addbody');

    a.classList.remove('hide');
}

function remaddbody() {
    var a = document.getElementById('addbody');

    a.classList.add('hide');
}


function tempupload(id, y) {

    const Form = document.getElementById('uploadForm');
    const Data = document.getElementById('track');
    const loaderTop = document.getElementById('loaderTop');
    const Pcint = document.getElementById('pcint');
    const Pcdec = document.getElementById('pcdec');
    const speed = document.getElementById('speed');
    var margin = document.getElementById('pcount');
    var lt = document.getElementById('lt');
    var uef = document.getElementById('uploadeditform');
    var error = document.getElementById('umusicerror');

    var emer = y;

    function setMargin(x) {

        if (x < 10) {
            speed.style.marginLeft = '27px';
        } else if (10 <= x < 100) {
            speed.style.marginLeft = '21px';
        } else if (x >= 100) {
            speed.style.marginLeft = '20px';
        }
    };

    Form.addEventListener('submit', uploadfunc);

    function uploadfunc(x) {

        const startTime = Date.now()
        var timeNow = 0;

        x.preventDefault();

        const xhtml = new XMLHttpRequest();

        xhtml.open('POST', 'process/uploadtrack?id=' + id + '&&emer=' + emer, true);
        xhtml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var pattern = /<div/;
                var response = this.responseText;

                error.classList.remove('hide');

                if (response.match(pattern)) {
                    document.getElementById('uploadeditform').style.color = "black !important";
                    document.getElementById('uploadeditform').innerHTML = this.responseText;
                } else {
                    error.innerHTML = response;
                    error.classList.add('formerrorani');
                    error.classList.add('lngtextfont');

                    // umusicerror_remove();
                }

                track.value = ""; // clears the input element
                Form.removeEventListener('submit', uploadfunc);

            }
        };

        xhtml.upload.addEventListener('progress', x => {

            // percentage progress
            const percent = x.lengthComputable ? (x.loaded / x.total) * 100 : 0;

            if (percent < 10) {

                Pcint.innerHTML = percent.toFixed(0);

                const dec = (percent.toFixed(2) + '').split('.')[1];
                Pcdec.innerHTML = '.' + dec + '%';

                const offset = 1000 - (percent * 5.62);
                loaderTop.style.strokeDashoffset = offset;

            } else if (percent >= 10 && percent < 100) {

                Pcint.innerHTML = percent.toFixed(0);

                const dec = (percent.toFixed(2) + '').split('.')[1];
                Pcdec.innerHTML = '.' + dec + '%';

                const offset = 1000 - (percent * 5.62);
                loaderTop.style.strokeDashoffset = offset;

                margin.style.margin = '-135px 0px 0px 160px';

            } else {

                Pcint.innerHTML = percent.toFixed(0);

                const dec = (percent.toFixed(2) + '').split('.')[1];
                Pcdec.innerHTML = '.' + dec + '%';

                const offset = 1000 - (percent * 7.83);
                loaderTop.style.strokeDashoffset = offset;

                margin.style.margin = '-135px 0px 0px 145px';

            }

            // upload speed
            x.lengthComputable ? [

                timeNow = Date.now(),

                spentTime = (timeNow - startTime) / 1000,

                sent = x.loaded / (1024 * 1000),

                final = (sent / spentTime).toFixed(1),

                final < 1 ? [
                    final *= 1024,
                    setMargin(final),
                    speed.innerHTML = final + " kb/s",
                ] : final >= 500 ? [
                    final = final / 1024,
                    setMargin(final),
                    speed.innerHTML = final + " gb/s",
                ] : [
                    setMargin(final),
                    speed.innerHTML = final + " mb/s",
                ],

            ] : false;

        });
        var sending = new FormData(Form);
        xhtml.send(sending);

    }

}

function umusicerror_remove() {

    var i = document.getElementById('umusicerror');

    setTimeout(() => {
        i.classList.remove('formerrorani');
        i.classList.remove('formsuccess');
        i.classList.remove("lngtextfont")
        i.innerHTML = "";
        i.classList.add('hide');
    }, 3000);


}

function permUpload(x, r, k, y) {

    var id = x;
    var file = r;
    var emer = y;
    var format = k;
    var sn = document.getElementById('songname').value;
    var an = document.getElementById('artist').value;
    var genre = document.getElementById('selgenre').value;
    var year = document.getElementById('selyear').value;
    var i = document.getElementById('formerror');
    var z = document.getElementById('focus');
    var uef = document.getElementById('uploadeditform');
    var date = Date.now();
    const speed = document.getElementById('speed');

    const loaderTop = document.getElementById('loaderTop');
    const Pcint = document.getElementById('pcint');
    const Pcdec = document.getElementById('pcdec');
    var margin = document.getElementById('pcount');

    // this removes the hide class so this is visible each time
    i.classList.remove('hide');

    if (sn == "") {

        z.scrollIntoView();
        i.innerHTML = "Sorry, song name field cannot be empty";
        i.classList.add('formerrorani');
        i.classList.add('lngtextfont');

        error_remove()
        return false

    } else if (an == "") {

        z.scrollIntoView();
        i.innerHTML = "Sorry, artist name field cannot be empty";
        i.classList.add('formerrorani');
        i.classList.add('lngtextfont');

        error_remove()
        return false

    } else if (genre == "") {

        z.scrollIntoView();
        i.innerHTML = "Sorry, genre field cannot be empty";
        i.classList.add('formerrorani');

        error_remove()
        return false

    } else if (year == "") {

        z.scrollIntoView();
        i.innerHTML = "Sorry, year field cannot be empty";
        i.classList.add('formerrorani');

        error_remove()
        return false

    } else {

        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "process/uploadtrackperm?id=" + id + "&&file=" + "/Websites/mitunes/Upload/Music/Temp/" + file + format + "&&format=" + format + "&&date=" + date + "&&emer=" + emer, true);
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                z.scrollIntoView();

                if (this.responseText == 'Upload Complete') {
                    i.innerHTML = this.responseText;
                    i.classList.add('formerrorani');
                    i.classList.add('formsuccess');
                } else {
                    i.innerHTML = 'Upload Failed';
                    i.classList.add('formerrorani');
                }

                error_remove()

                setTimeout(() => {
                    uef.innerHTML = "";
                    loaderTop.style.strokeDashoffset = '1000';
                    margin.style.margin = '-135px 0px 0px 165px'
                    Pcint.innerHTML = '0';
                    speed.innerHTML = '';
                }, 3100);
            }
        };
        var a = document.getElementById('uefmainid');
        var data = new FormData(a)
        xhttp.send(data);

        return false
    }

}

function changeCA(x) {

    var file = x
    var a = document.getElementById('pghfca');

    a.innerHTML = ""
    a.classList.remove('material-icons-round');
    a.classList.remove('ccasicon');
    a.classList.add("preloader_circle_white");

    var xhtml = new XMLHttpRequest();
    xhtml.open('POST', 'process/changeca.php?file=' + "../Upload/Music/Temp/" + file + ".mp3", true);
    xhtml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            var response = this.responseText;
            var pattern = /data:image/;

            if (response.match(pattern)) {

                document.getElementById('cA').src = xhtml.responseText;

                cA_remove_loader_done()

            } else {

                var i = document.getElementById('formerror');

                i.innerHTML = response;
                i.classList.add('formerrorani');
                i.classList.add('lngtextfont');

                setTimeout(() => {
                    i.innerHTML = "";
                    i.classList.remove('formerrorani');
                    i.classList.remove('lngtextfont');
                }, 3000);

                cA_remove_loader_failed()

            }

        }
    };
    var form = document.getElementById('uefmainid');
    var data = new FormData(form)
    xhtml.send(data);

    // this empties the value field
    var fileInput = document.getElementById('ccA');
    fileInput.value = '';

}

function cA_remove_loader_done() {

    var a = document.getElementById('pghfca');

    a.classList.add('ccasicon');
    a.classList.add('material-icons-round');
    a.innerHTML = 'done';
    a.classList.remove('preloader_circle_white');

    setTimeout(
        function done() {

            a.innerHTML = 'edit';

        }
        , 2000
    )

}

function cA_remove_loader_failed() {

    var a = document.getElementById('pghfca');

    a.classList.add('ccasicon');
    a.classList.add('material-icons-round');
    a.innerHTML = 'clear';
    a.classList.remove('preloader_circle_white');

    setTimeout(
        function done() {

            a.innerHTML = 'edit';

        }
        , 2000
    )

}

function delupload(x, y) {

    var user = x;
    var fileid = y;
    var albumName = null;

    streams_count_reduce(fileid, user);

    uploads_count_reduce(user);

    remove_views(user, albumName, fileid);

    uploads_del(fileid, user);

}

function remove_views(x, y, z, a) {

    var userid = x;
    var albumName = y;
    var songid = z;
    var artist = a;

    if (albumName == null) {
        var xhtml = new XMLHttpRequest();
        xhtml.open('POST', 'process/remove_views?songid=' + songid + '&&userid=' + userid, true);
        xhtml.send();
    } else if (songid == null) {
        var xhtml = new XMLHttpRequest();
        xhtml.open('POST', 'process/remove_views?albumName=' + albumName + '&&userid=' + userid + '&&artist=' + artist, true);
        xhtml.send();
    }
}

function uploads_del(x, y) {

    var fileid = x;
    var user = y;
    var elem = document.getElementById('uedfull');

    var xhtml = new XMLHttpRequest();
    xhtml.open('POST', 'process/delupload2?file=' + fileid + '&&user=' + user, true);
    xhtml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var pattern = /\[ERROR\]\:/;

            if (this.responseText.match(pattern)) {
                displayFMsg(this.responseText.replace(pattern, ''));
            } else {
                elem.innerHTML = this.responseText;
                setDimensions();
            }
        }
    };
    xhtml.send();

}

function uploads_count_reduce(x) {

    var id = x;
    var elem = document.getElementById('uploads_count');

    var xhtml = new XMLHttpRequest();
    xhtml.open('POST', 'process/delupload1?user=' + id, true);
    xhtml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            elem.innerHTML = this.responseText;
        }
    };
    xhtml.send();

}

function streams_count_reduce(x, y) {

    var file = x;
    var user = y;
    var elem = document.getElementById('streams_count');

    var xhtml = new XMLHttpRequest();
    xhtml.open('POST', 'process/delupload3?file=' + file + '&&user=' + user, true);
    xhtml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            elem.innerHTML = this.responseText;
        }
    };
    xhtml.send();

}

function fanjoin(x, y) {

    var follower = x;
    var following = y;
    var elem = document.getElementById('fmasbo');
    var date = Date.now();

    var xhttp = new XMLHttpRequest();
    xhttp.open('POST', 'process/addfan?follower=' + follower + '&&following=' + following + '&&date=' + date, true);
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            elem.innerHTML = this.responseText;
            asbo_fan(y);
        }
    };
    xhttp.send()

}

function fanleave(x, y) {

    var follower = x;
    var following = y;
    var elem = document.getElementById('fmasbo');

    var xhttp = new XMLHttpRequest();
    xhttp.open('POST', 'process/remfan?follower=' + follower + '&&following=' + following, true);
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            elem.innerHTML = this.responseText;
            asbo_fan(y);
        }
    };
    xhttp.send()

}

function asbo_fan(x) {

    var id = x;
    var a = document.getElementById('asbofans');

    var xhttp = new XMLHttpRequest();
    xhttp.open('POST', 'process/asboFan?id=' + id, true);
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            a.innerHTML = this.responseText;
        }
    };
    xhttp.send()

}

function pick(x) {

    var a = document.getElementById('mmm');
    var b = document.getElementById('ccc');
    var c = document.getElementById('mmamain');
    var d = document.getElementById('ccamain');

    if (x == 'c') {
        a.classList.remove('pickm');
        b.classList.add('pickc');
        d.classList.remove('hide');
        c.classList.add('hide');
    } else if (x == 'm') {
        a.classList.add('pickm');
        b.classList.remove('pickc');
        c.classList.remove('hide');
        d.classList.add('hide');
    }

}

function fromAsciiToString(x) {

    while (x.search(/&#/) != -1) {

        pos = x.search(/&#/);

        if (x[pos + 2] == 1) {
            // +5 because it stops one before the end
            asciicode = x.slice(pos, pos + 5);
            converted = String.fromCharCode(asciicode.replace('&#', ''));
            x = x.replace(asciicode, converted);
        } else {
            asciicode = x.slice(pos, pos + 4);
            converted = String.fromCharCode(asciicode.replace('&#', ''));
            x = x.replace(asciicode, converted);
        }

    }

    return x;

}

// does not have an eventlistener tray because it never creates double events
function sv_controls_main(x, y, z) {

    var file = fromAsciiToString(x);
    var file = file.replace('C:/xampp/htdocs/Websites/mitunes/', '');

    var wrapper = document.getElementById('wrapper');

    var songid = y;
    var userid = z;
    var date = Date.now();

    const playBtn = document.getElementById('playbtn');
    const pauseBtn = document.getElementById('pausebtn');
    const loopBtn = document.getElementById('loop');
    const shuffle = document.getElementById('shuffle');
    const spBtn = document.getElementById('spbtn');
    const snBtn = document.getElementById('snbtn');
    const current = document.getElementById('current');
    const max = document.getElementById('max');
    const max2 = document.getElementById('max2');
    const stopBtn = document.getElementsByClassName('stop');
    const stopBtnSelf = document.getElementById('stop');
    const wavePreloader = document.getElementById('wavePreloader');
    const sv_count = document.getElementById('sv_count');

    // variables for line spectrum
    var line = document.getElementsByClassName('line_px');
    var ball = document.getElementById('ball');
    const increment = 0.75;

    sv_count.classList.add('hide');

    var wavesurfer = WaveSurfer.create({
        container: '#waveform',
        scrollParent: false,
        barGap: .1,
        barHeight: .5,
        barRadius: 2,
        barWidth: 1,
        cursorColor: '#0000',
        cursorWidth: 0,
        responsive: true
    });

    wavesurfer.on('ready', function () {

        sv_count.classList.remove('hide');
        wavePreloader.classList.add('hide');

        var Timer = function (callback, delay) {
            var timerId, start, remaining = delay;

            this.pause = function () {
                window.clearTimeout(timerId);
                remaining -= Date.now() - start;
            };

            this.resume = function () {
                start = Date.now();
                window.clearTimeout(timerId);
                timerId = window.setTimeout(callback, remaining);
            };

        };

        var viewTime = Math.round((wavesurfer.getDuration() * 1000) * 0.15);
        var timer = new Timer(function () {
            var xhttp = new XMLHttpRequest();
            xhttp.open('POST', 'process/addView.php?date=' + date + '&&userid=' + userid + '&&songid=' + songid, true);
            xhttp.send();

            // destroy old timer else when timer is called for resume it will set a timout with 0 seconds
            timer = ''

        }, viewTime);

        playBtn.addEventListener('click', function () {
            pauseBtn.classList.remove('hide');
            playBtn.classList.add('hide');

            reason_for_click = 'stop';
            for (let index = 0; index < stopBtn.length; index++) {
                const element = stopBtn[index];
                if (element != stopBtnSelf) {
                    element.click();
                }
            }

            wavesurfer.play();

            if (timer != '') {
                timer.resume();
            }

        });

        pauseBtn.addEventListener('click', function () {
            playBtn.classList.remove('hide');
            pauseBtn.classList.add('hide');

            wavesurfer.pause();

            if (timer != '') {
                timer.pause();
            }

        });

        loopBtn.addEventListener('click', function () {
            if (loopBtn.classList.contains('svcexr_new')) {
                loopBtn.classList.remove('svcexr_new');
            } else {
                loopBtn.classList.add('svcexr_new');
            }
        });

        stopBtnSelf.addEventListener('click', function () {
            playBtn.classList.remove('hide');
            pauseBtn.classList.add('hide');

            wavesurfer.pause();

            if (timer != '') {
                timer.pause();
            }
        });

        loopBtn.addEventListener('click', function () {
            if (loopBtn.classList.contains('svcexr_new')) {
                wavesurfer.on('finish', function () {
                    pauseBtn.classList.remove('hide');
                    playBtn.classList.add('hide');
                    wavesurfer.play();
                });
            } else {
                wavesurfer.on('finish', function () {
                    wavesurfer.pause();
                    playBtn.classList.remove('hide');
                    pauseBtn.classList.add('hide');
                });
            }
        });

        spBtn.addEventListener('click', function () {
            wavesurfer.skipBackward(15);

            if (playBtn.classList.contains('hide')) {
                wavesurfer.play();
            }

            var totalTime2 = wavesurfer.getCurrentTime();
            var minTime2 = totalTime2.toFixed(0) / 60;
            var secTime2 = totalTime2.toFixed(0) % 60;

            if (secTime2 < 10) {
                secTime2 = '0' + secTime2;
            }

            minTime2 = Math.floor(minTime2);

            var done2 = minTime2 + ':' + secTime2;
            current.innerHTML = done2;
        });

        snBtn.addEventListener('click', function () {
            wavesurfer.skipForward(15);

            if (playBtn.classList.contains('hide')) {
                wavesurfer.play();
            }

            var totalTime2 = wavesurfer.getCurrentTime();
            var minTime2 = totalTime2.toFixed(0) / 60;
            var secTime2 = totalTime2.toFixed(0) % 60;

            if (secTime2 < 10) {
                secTime2 = '0' + secTime2;
            }

            minTime2 = Math.floor(minTime2);

            var done2 = minTime2 + ':' + secTime2;
            current.innerHTML = done2;
        });

        max.addEventListener('click', function () {
            max2.classList.remove('hide');
            max.classList.add('hide');
        });

        max2.addEventListener('click', function () {
            max.classList.remove('hide');
            max2.classList.add('hide');
        });

        wavesurfer.on('finish', function () {
            playBtn.classList.remove('hide');
            pauseBtn.classList.add('hide');
        });

        for (let index = 0; index < line.length; index++) {
            const element = line[index];
            element.addEventListener('click', () => {
                click = index / 100
                click_relative_to_wavesurfer = click * wavesurfer.getDuration();

                wavesurfer.setCurrentTime(click_relative_to_wavesurfer);

                const duration = wavesurfer.getDuration();
                const currT = wavesurfer.getCurrentTime();
                var multiplier = (currT / duration) * 100;

                var newMargin = 75 - (increment * multiplier);
                ball.style.margin = '8px 0px 0px -' + newMargin + '%';

                var lineSpace = multiplier;

                for (let k = 0; k < line.length; k++) {
                    const element = line[k];
                    element.style.borderBottom = '1px solid gray';
                }

                for (let j = 0; j <= lineSpace; j++) {
                    const element = line[j];
                    element.style.borderBottom = '3px solid darkgray';
                }

            })
        }

        var totalTime = wavesurfer.getDuration();
        var minTime = totalTime.toFixed(0) / 60;
        var secTime = totalTime.toFixed(0) % 60;
        minTime = Math.floor(minTime);

        if (secTime < 10) {
            secTime = '0' + secTime;
        }

        var done = minTime + ':' + secTime;
        max.innerHTML = done;

        max2.innerHTML = '-' + done;

        current.innerHTML = '0:00';

    });

    wavesurfer.on('audioprocess', function () {
        if (wavesurfer.isPlaying()) {
            var totalTime2 = wavesurfer.getCurrentTime();
            var minTime2 = totalTime2.toFixed(0) / 60;
            var secTime2 = totalTime2.toFixed(0) % 60;

            if (secTime2 < 10) {
                secTime2 = '0' + secTime2;
            }

            minTime2 = Math.floor(minTime2);

            var done2 = minTime2 + ':' + secTime2;
            current.innerHTML = done2;


            // Timer for the Negative count
            var tT = wavesurfer.getDuration();
            var cT = wavesurfer.getCurrentTime();

            var rT = tT - cT;
            var mT = rT.toFixed(0) / 60;
            var sT = rT.toFixed(0) % 60;
            sT = sT.toFixed(0);
            mT = Math.floor(mT);

            if (sT < 10) {
                sT = '0' + sT;
            }

            d3 = '-' + mT + ':' + sT;

            if (mT == 0 && sT == 0) {
                d3 = mT + ':' + sT;
            }

            max2.innerHTML = d3;


            // Code already built for line spectrum

            const duration = wavesurfer.getDuration();
            const currT = wavesurfer.getCurrentTime();
            var multiplier = (currT / duration) * 100;

            if (ball != undefined && ball != null) {
                var newMargin = 75 - (increment * multiplier);
                ball.style.margin = '8px 0px 0px -' + newMargin + '%';

                var lineSpace = multiplier;

                for (let k = 0; k < line.length; k++) {
                    const element = line[k];
                    element.style.borderBottom = '1px solid gray';
                }

                for (let j = 0; j <= lineSpace; j++) {
                    const element = line[j];
                    element.style.borderBottom = '3px solid darkgray';
                }
            }
        }
    });

    wavesurfer.on('seek', () => {
        var totalTime2 = wavesurfer.getCurrentTime();
        var minTime2 = totalTime2.toFixed(0) / 60;
        var secTime2 = totalTime2.toFixed(0) % 60;

        if (secTime2 < 10) {
            secTime2 = '0' + secTime2;
        }

        minTime2 = Math.floor(minTime2);

        var done2 = minTime2 + ':' + secTime2;
        current.innerHTML = done2;


        // Timer for the Negative count
        var tT = wavesurfer.getDuration();
        var cT = wavesurfer.getCurrentTime();

        var rT = tT - cT;
        var mT = rT.toFixed(0) / 60;
        var sT = rT.toFixed(0) % 60;
        sT = sT.toFixed(0);
        mT = Math.floor(mT);

        if (sT < 10) {
            sT = '0' + sT;
        }

        d3 = '-' + mT + ':' + sT;

        if (mT == 0 && sT == 0) {
            d3 = mT + ':' + sT;
        }

        max2.innerHTML = d3;

        if (pauseBtn.classList.contains('hide') == false) {
            wavesurfer.play();
        }
    });

    wavesurfer.load(file);

}

sm_events = [];
function sv_mini(x, y, z, a) {

    var id = x;
    var file = y;
    file = file.replace('C:/xampp/htdocs/Websites/mitunes/', '');
    var userid = a;
    var songid = z;
    var date = Date.now();

    var playBtn = document.getElementById('exPlay' + id);
    var pauseBtn = document.getElementById('exPause' + id);
    var playBtnAfter = document.getElementById('exPlayAfter' + id);
    var stopBtn = document.getElementsByClassName('stop');
    var stopBtnSelf = document.getElementById('stop' + id);
    var pL = document.getElementById('exPreloader' + id);

    pL.classList.remove('hide');
    playBtn.classList.add('hide');

    var call = '#exSpectrum' + id;

    var wavesurfer = WaveSurfer.create({
        container: call
    });

    wavesurfer.on('ready', function () {

        pL.classList.add('hide');

        reason_for_click = 'stop';
        for (let index = 0; index < stopBtn.length; index++) {
            const element = stopBtn[index];
            if (element != stopBtnSelf) {
                element.click();
            }
        }
        wavesurfer.play();

        pauseBtn.classList.remove('hide');

        var Timer = function (callback, delay) {
            var timerId, start, remaining = delay;

            this.pause = function () {
                window.clearTimeout(timerId);
                remaining -= Date.now() - start;
            };

            this.resume = function () {
                start = Date.now();
                window.clearTimeout(timerId);
                timerId = window.setTimeout(callback, remaining);
            };

            this.resume();

        };

        var viewTime = Math.round((wavesurfer.getDuration() * 1000) * 0.15);
        var timer = new Timer(function () {
            var xhttp = new XMLHttpRequest();
            xhttp.open('POST', 'process/addView.php?date=' + date + '&&userid=' + userid + '&&songid=' + songid, true);
            xhttp.send();

            // destroying old timer because if you dont if will have a settimout with 0seconds and every click of the playbtn to resume timer will fire this XHR request
            timer = '';

        }, viewTime);

        pauseBtn.addEventListener('click', sm_pause);
        sm_events.push([pauseBtn, sm_pause]);
        function sm_pause() {
            playBtnAfter.classList.remove('hide');
            pauseBtn.classList.add('hide');

            if (timer != '') {
                timer.pause();
            }

            wavesurfer.pause();
        };

        playBtnAfter.addEventListener('click', sm_playAfter);
        sm_events.push([playBtnAfter, sm_playAfter]);
        function sm_playAfter() {
            reason_for_click = 'stop';
            for (let index = 0; index < stopBtn.length; index++) {
                const element = stopBtn[index];
                if (element != stopBtnSelf) {
                    element.click();
                }
            }

            playBtnAfter.classList.add('hide');
            pauseBtn.classList.remove('hide');

            wavesurfer.play();

            if (timer != '') {
                timer.resume();
            }
        };

        stopBtnSelf.addEventListener('click', sm_stop);
        sm_events.push([stopBtnSelf, sm_stop]);
        function sm_stop() {
            wavesurfer.empty();
            wavesurfer.pause();

            playBtnAfter.classList.remove('hide');
            pauseBtn.classList.add('hide');

            if (timer != '') {
                timer.pause();
            }
        };

    });

    wavesurfer.on('finish', function () {
        wavesurfer.pause();
        playBtn.classList.remove('hide');
        pauseBtn.classList.add('hide');

        sm_events.forEach((content, index) => {
            content[0].removeEventListener('click', content[1]);
        });
    });

    wavesurfer.load(file);

}

var smam_events = []
function sv_mini_album_main(x, y, z, a) {

    var id = x;
    var fileid = y;
    var totalFiles = z;
    var album = a;

    var playBtn = document.getElementById('exAlbum4' + album + 'PlayMain' + id);
    var pauseBtn = document.getElementById('exAlbum4' + album + 'PauseMain' + id);
    var playBtnAfter = document.getElementById('exAlbum4' + album + 'PlayAfterMain' + id);
    var pL = document.getElementById('exAlbum4' + album + 'PreloaderMain' + id);
    var stopBtn = document.getElementsByClassName('stop');
    var stopBtnSelf = document.getElementById('exAlbum4' + album + 'stop' + id);
    var openBtn = document.getElementById('exAlbum4' + album + 'OpenMain' + id);
    var closeBtn = document.getElementById('exAlbum4' + album + 'CloseMain' + id);
    var subMenu = document.getElementById('subMenu4' + album);

    playBtn.classList.add('hide');
    pL.classList.remove('hide');

    // useful from 2nd track
    pauseBtn.classList.add('hide');

    if (openBtn.classList.contains('hide') == false) {
        openBtn.click();
    }

    var call = '#exSpectrum' + id;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process/scandir4JS?path=' + album + '&&limit=' + fileid, true);
    xhr.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {

            var file = this.responseText;
            var realPauseBtn = document.getElementById('exAlbum4' + album + 'Pause' + fileid);
            var realPlayBtnAfter = document.getElementById('exAlbum4' + album + 'PlayAfter' + fileid);
            var realPlayBtn = document.getElementById('exAlbum4' + album + 'Play' + fileid);

            // to check if the first song is already playing
            if (fileid == 1 && realPauseBtn.classList.contains('hide') == false) {
                realPauseBtn.click();
                realPlayBtnAfter.classList.add('hide');
                playBtnAfter.classList.add('hide');
            }

            var wavesurfer = WaveSurfer.create({
                container: call
            });

            wavesurfer.on('ready', function () {

                pL.classList.add('hide');
                pauseBtn.classList.remove('hide');

                pauseBtn.addEventListener('click', MainpBtn_am_func);
                smam_events.push([pauseBtn, MainpBtn_am_func]);
                function MainpBtn_am_func() {
                    realPauseBtn.click();

                    pauseBtn.classList.add('hide');
                    playBtnAfter.classList.remove('hide');

                }

                realPauseBtn.addEventListener('click', subpBtn_am_func);
                smam_events.push([realPauseBtn, subpBtn_am_func]);
                function subpBtn_am_func() {

                    pauseBtn.classList.add('hide');
                    playBtnAfter.classList.remove('hide');

                    if (next_timer != '') {
                        next_timer.pause();
                    }

                }

                playBtnAfter.addEventListener('click', MainpABtn_am_func);
                smam_events.push([playBtnAfter, MainpABtn_am_func]);
                function MainpABtn_am_func() {

                    realPlayBtnAfter.click();

                    playBtnAfter.classList.add('hide');
                    pauseBtn.classList.remove('hide');

                    if (openBtn.classList.contains('hide') == false) {
                        openBtn.click();
                    }

                }

                realPlayBtnAfter.addEventListener('click', subpBtnAfter_am_func);
                smam_events.push([realPlayBtnAfter, subpBtnAfter_am_func]);
                function subpBtnAfter_am_func() {

                    playBtnAfter.classList.add('hide');
                    pauseBtn.classList.remove('hide');

                    if (next_timer != '') {
                        next_timer.resume();
                    }

                }

                stopBtnSelf.addEventListener('click', MainsBtn_am_func);
                smam_events.push([stopBtnSelf, MainsBtn_am_func]);
                function MainsBtn_am_func() {

                    if (reason_for_click == 'stop') {

                        realPauseBtn.click();

                        // could later make it continue from where you stop rather than start from beginning #because ur releasing the playBtn
                        pauseBtn.classList.add('hide');
                        playBtnAfter.classList.add('hide');
                        playBtn.classList.remove('hide');

                        if (next_timer != '') {
                            next_timer.pause();
                            next_timer = '';
                        }

                    }

                }

                var Timer = function (callback, delay) {
                    var timerId, start, remaining = delay;

                    this.pause = function () {
                        window.clearTimeout(timerId);
                        remaining -= Date.now() - start;
                    };

                    this.resume = function () {
                        start = Date.now();
                        window.clearTimeout(timerId);
                        timerId = window.setTimeout(callback, remaining);
                    };

                    this.resume();

                };

                var timeout = (wavesurfer.getDuration() * 1000) + 500;
                var next_timer = new Timer(function () {

                    if (y < totalFiles) {
                        y = y + 1;
                        sv_mini_album_main(x, y, z, a)
                    } else {

                        pauseBtn.classList.add('hide')
                        playBtn.classList.remove('hide');

                        // this creates a more humane feel to it
                        setTimeout(() => {
                            closeBtn.click();
                        }, 500);
                    }

                    smam_events.forEach((content, index) => {
                        content[0].removeEventListener('click', content[1]);
                    })
                    // empty the tray when done
                    smam_events = [];

                    // destroys old timer else it will keep firing this settimeout with 0seconds but doesnt use the timer check as others because when a new 
                    // song starts it creates a new timer
                    next_timer = '';

                }, timeout);

            });

            wavesurfer.load(file);
            realPlayBtn.click();

            reason_for_click = '';

        }
    }
    xhr.send();

}

function reveal_subMenu(x, y) {
    var id = x;
    var album = y;

    var openBtn = document.getElementById('exAlbum4' + album + 'OpenMain' + id);
    var closeBtn = document.getElementById('exAlbum4' + album + 'CloseMain' + id);
    var subMenu = document.getElementById('subMenu4' + album);

    openBtn.classList.add('hide');
    closeBtn.classList.remove('hide');
    subMenu.classList.remove('hide');

    closeBtn.addEventListener('click', () => {
        closeBtn.classList.add('hide');
        openBtn.classList.remove('hide');
        subMenu.classList.add('hide');
    });

}

var sma_events = [];
var reason_for_click = '';
function sv_mini_album(x, y, z, a, b, c) {

    reason_for_click = 'stop';

    var id = x;
    var file = y;
    var userid = a;
    var songid = z;
    var album = b;
    var albumid = c;
    var date = Date.now();

    var playBtn = document.getElementById('exAlbum4' + album + 'Play' + id);
    var pauseBtn = document.getElementById('exAlbum4' + album + 'Pause' + id);
    var playBtnAfter = document.getElementById('exAlbum4' + album + 'PlayAfter' + id);
    var stopBtn = document.getElementsByClassName('stop');
    var stopBtnSelf = document.getElementById('exAlbum4' + album + 'stop' + id);
    var pL = document.getElementById('exAlbum4' + album + 'Preloader' + id);

    // for speaker effects
    var speaker1 = document.getElementById('exAlbum4' + album + 'Speaker1' + id);
    var speaker2 = document.getElementById('exAlbum4' + album + 'Speaker2' + id);
    var speaker3 = document.getElementById('exAlbum4' + album + 'Speaker3' + id);
    var speakerDiv = document.getElementById('exAlbum4' + album + 'SpeakerDiv' + id);
    var trackNo = document.getElementById('trackNo4' + album + id);

    var playing = 0;
    var stage = 0;

    function speakerEffects() {

        if (playing == 1) {
            trackNo.classList.add('hide');
            speaker3.classList.add('hide');
            speaker1.classList.remove('hide');

            if (playing == 1) {
                setTimeout(() => {

                    speaker1.classList.add('hide');
                    speaker2.classList.remove('hide');

                    if (playing == 1) {
                        setTimeout(() => {

                            speaker2.classList.add('hide');
                            speaker3.classList.remove('hide');

                            if (playing == 1) {
                                setTimeout(() => {

                                    speakerEffects();

                                }, 500);
                            } else {
                                stage = 4;
                            }

                        }, 500);
                    } else {
                        stage = 3;
                    }

                }, 500);
            } else {
                stage = 2;
            }

        } else {
            stage = 1;
        }

    }

    function removeSpeakerEffects() {
        speaker1.classList.add('hide');
        speaker2.classList.add('hide');
        speaker3.classList.add('hide');
        speakerDiv.classList.add('hide');
        trackNo.classList.remove('hide');
    }

    function continueSpeakerEffects(x) {

        if (x == 1) {
            trackNo.classList.add('hide');
            speaker3.classList.add('hide');
            speaker1.classList.remove('hide');

            if (playing == 1) {
                setTimeout(() => {

                    speaker1.classList.add('hide');
                    speaker2.classList.remove('hide');

                    if (playing == 1) {
                        setTimeout(() => {

                            speaker2.classList.add('hide');
                            speaker3.classList.remove('hide');

                            if (playing == 1) {
                                setTimeout(() => {

                                    speakerEffects();

                                }, 500);
                            } else {
                                stage = 4;
                            }

                        }, 500);
                    } else {
                        stage = 3;
                    }

                }, 500);
            } else {
                stage = 2;
            }


        } else if (x == 2) {

            speaker1.classList.add('hide');
            speaker2.classList.remove('hide');

            if (playing == 1) {
                setTimeout(() => {

                    speaker2.classList.add('hide');
                    speaker3.classList.remove('hide');

                    if (playing == 1) {
                        setTimeout(() => {

                            speakerEffects();

                        }, 500);
                    } else {
                        stage = 4;
                    }

                }, 500);
            } else {
                stage = 3;
            }

        } else if (x == 3) {

            speaker2.classList.add('hide');
            speaker3.classList.remove('hide');

            if (playing == 1) {
                setTimeout(() => {

                    speakerEffects();

                }, 500);
            } else {
                stage = 4;
            }

        } else if (x == 4) {

            setTimeout(() => {

                speakerEffects();

            }, 500);

        }

    }

    // wavesurfer begins
    playBtn.classList.add('hide');
    playBtnAfter.classList.add('hide');
    pL.classList.remove('hide');

    var call = '#exAlbum4Spectrum' + id;

    var wavesurfer = WaveSurfer.create({
        container: call
    });

    wavesurfer.on('ready', function () {

        for (let index = 0; index < stopBtn.length; index++) {
            const element = stopBtn[index];
            if (element != stopBtnSelf) {
                element.click();
            }
        }

        pL.classList.add('hide');
        pauseBtn.classList.remove('hide');

        wavesurfer.play();

        speakerDiv.classList.remove('hide');

        playing = 1;
        speakerEffects();

        pauseBtn.addEventListener('click', pBtn_am_func);
        sma_events.push([pauseBtn, pBtn_am_func]);
        function pBtn_am_func() {

            wavesurfer.pause();

            playing = 0;

            pauseBtn.classList.add('hide');
            playBtnAfter.classList.remove('hide');

            if (timer != '') {
                timer.pause();
            }

        }

        playBtnAfter.addEventListener('click', pBtnA_am_func);
        sma_events.push([playBtnAfter, pBtnA_am_func]);
        function pBtnA_am_func() {

            for (let index = 0; index < stopBtn.length; index++) {
                const element = stopBtn[index];
                if (element != stopBtnSelf) {
                    element.click();
                }
            }

            wavesurfer.play();

            playing = 1;
            speakerDiv.classList.remove('hide');

            playBtnAfter.classList.add('hide');
            pauseBtn.classList.remove('hide');

            playing = 1;
            continueSpeakerEffects(stage);

            if (timer != '') {
                timer.resume();
            }

        }

        stopBtnSelf.addEventListener('click', sBtnS_am_func);
        sma_events.push([stopBtnSelf, sBtnS_am_func]);
        function sBtnS_am_func() {
            wavesurfer.empty();
            wavesurfer.pause();

            playing = 0;
            removeSpeakerEffects();

            pauseBtn.classList.add('hide');
            playBtnAfter.classList.add('hide');
            playBtn.classList.remove('hide');

            if (timer != '') {
                timer.pause();
                timer = '';
            }

            sma_events.forEach((content, index) => {
                content[0].removeEventListener('click', content[1]);
            })
            events = [];

        }

        var Timer = function (callback, delay) {
            var timerId, start, remaining = delay;

            this.pause = function () {
                window.clearTimeout(timerId);
                remaining -= Date.now() - start;
            };

            this.resume = function () {
                start = Date.now();
                window.clearTimeout(timerId);
                timerId = window.setTimeout(callback, remaining);
            };

            this.resume();

        };

        var viewTime = Math.round((wavesurfer.getDuration() * 1000) * 0.15);
        var timer = new Timer(function () {
            var xhttp = new XMLHttpRequest();
            xhttp.open('POST', 'process/addView4Album.php?date=' + date + '&&userid=' + userid + '&&songid=' + songid + '&&albumid=' + albumid, true);
            xhttp.send();

            // destroys old timer see other wavesurfer for reason
            timer = '';

        }, viewTime);

    });

    wavesurfer.on('finish', () => {
        wavesurfer.empty();
        wavesurfer.pause();

        playing = 0;
        removeSpeakerEffects();

        pauseBtn.classList.add('hide');
        playBtn.classList.remove('hide');

        sma_events.forEach((content, index) => {
            content[0].removeEventListener('click', content[1]);
        })
        events = [];

    });

    wavesurfer.load(file);

}

// sound for swelling and also bursting by His Grace
var swell = new Audio("Upload/Music/animationSounds/swell.wav");

function play(x) {

    var elem = document.getElementById('padd_menu');
    var body = document.getElementsByTagName('BODY')[0];

    switch (x) {
        case 'on':

            elem.classList.remove('hide');
            body.style.overflow = 'hidden';

            break;

        case 'off':

            elem.classList.add('hide');
            body.style.overflow = 'scroll';

            break;

        default:
            break;
    }

}

function play_1(x) {

    var choice = x;
    var wrapper = document.getElementById('padd_wrapper');
    var menu = document.getElementById('padd_menu');

    var sec1 = document.getElementById('sec1');
    var sec2 = document.getElementById('sec2');

    var back_arrow = document.getElementById('p1off');

    if (x == "new") {
        wrapper.style.position = 'absolute';
        sec2.classList.remove('hide');
        wrapper.classList.add('pleft'),
            setTimeout(() => {
                wrapper.classList.add('pleftmod');
                menu.style.height = '340px';
                sec2.classList.add('t2');
                back_arrow.classList.remove('hide');
                setTimeout(() => {
                    wrapper.classList.add('hide');
                }, 200);
            }, 1);
    } else if (x == "existing") {
        wrapper.style.position = 'absolute';
        sec1.classList.remove('hide');
        wrapper.classList.add('pright'),
            setTimeout(() => {
                back_arrow.classList.remove('hide');
                wrapper.classList.add('prightmod');
                setTimeout(() => {
                    wrapper.classList.add('hide');
                }, 100);
                menu.style.height = '340px';
                sec1.classList.add('t1');
            }, 100);
    }

}

function play_1_off() {

    var back_arrow = document.getElementById('p1off');
    var wrapper = document.getElementById('padd_wrapper');
    var menu = document.getElementById('padd_menu');
    var sec1 = document.getElementById('sec1');
    var sec2 = document.getElementById('sec2');

    if (wrapper.classList.contains('pleft')) {

        back_arrow.classList.add('hide');
        wrapper.classList.remove('hide');
        sec2.classList.remove('t2');
        menu.style.height = '170px';
        wrapper.classList.remove('pleftmod');
        wrapper.classList.remove('pleft');
        sec2.classList.add('hide');
        wrapper.style.position = '';
    }

    if (wrapper.classList.contains('pright')) {

        back_arrow.classList.add('hide');
        wrapper.classList.remove('hide');
        sec1.classList.remove('t1');
        menu.style.height = '170px';
        wrapper.classList.remove('prightmod');
        wrapper.classList.remove('pright');
        sec1.classList.add('hide');
        wrapper.style.position = '';

    }

}

function changePCa() {

    var icon = document.getElementById('secArticon');
    var image = document.getElementById('secArtimg');
    var imginfo = document.getElementById('realca');
    const form = document.getElementById('secForm');

    icon.classList.remove('material-icons-round');
    icon.classList.add('preloader_circle');
    icon.classList.add("preloader_mod");
    icon.classList.add('make_white');
    icon.innerHTML = "";

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process/changePCa', true);
    xhr.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {

            var response = this.responseText;
            var pattern = /i_worked/;


            icon.classList.remove('preloader_circle');
            icon.classList.remove("preloader_mod");
            icon.classList.remove('make_white');
            icon.classList.add('material-icons-round');
            if (response.match(pattern)) {
                response = response.replace('i_worked', '');
                image.src = response;
                imginfo.value = response;

                icon.innerHTML = "done";
                setTimeout(() => {
                    icon.innerHTML = "add_a_photo";
                }, 1000);

            } else {

                displayFMsg(response);

                icon.innerHTML = "clear";
                setTimeout(() => {
                    icon.innerHTML = "add_a_photo";
                }, 1000);
            }

        }
    }
    var Data = new FormData(form);
    xhr.send(Data)

}

function createPlaylist(x, y) {

    var userid = x;
    var songid = y;
    var date = Date.now();

    var body = document.getElementsByTagName("body")[0];

    var form = document.getElementById('secForm');
    var title = document.getElementById('title').value;
    var ca = document.getElementById('realca').value;

    var icon = document.getElementById('playlisticon');
    var icon2 = document.getElementById('playlisticon2');


    title = title.trim()

    if (ca == "" && title != "") {
        displayFMsg("Please Change the Cover Art")
    } else if (ca != "" && title == "") {
        displayFMsg("Please include a playlist title");
    } else if (ca == "" && title == "") {
        displayFMsg("Please fill in the spaces")
    } else {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', 'process/createPlaylist?userid=' + userid + '&&songid=' + songid + '&&date=' + date, true);
        xhttp.onreadystatechange = function () {
            if (this.status == 200 && this.readyState == 4) {
                var response = this.responseText;
                var pattern = /Done/;

                if (response.match(pattern)) {

                    updateList(userid, songid);

                    displaySMsg(response);

                    icon.classList.add("hide");
                    icon2.classList.remove('hide');

                    clearPlayForm();

                } else {
                    displayFMsg(response);
                }
            }
        }
        const Data = new FormData(form);
        xhttp.send(Data);
    }

    // body.style.overflow = "hidden";

    return false;

}

function updateList(x, y) {

    var userid = x;
    var songid = y;

    var sec1 = document.getElementById('sec1');

    var xhttp = new XMLHttpRequest();
    xhttp.open('POST', 'process/updateList?userid=' + userid + "&&songid=" + songid, true);
    xhttp.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            var response = this.responseText;
            var pattern = /<div/;

            if (response.match(pattern)) {

                sec1.innerHTML = response;

            }
        }
    }
    xhttp.send();

}

function clearPlayForm() {

    var title = document.getElementById('title');
    var des = document.getElementById('des');
    var ca = document.getElementById('realca');
    var image = document.getElementById('secArtimg');

    title.value = "";
    des.value = "";
    ca.value = "";
    image.src = "Upload/Img/Profile/Default/cp/cp5.jpeg";

    var back = document.getElementById('p1off');
    back.click();

}

function rem_play(x, y) {

    var songid = x;
    var userid = y;

    var p1 = document.getElementById("playlisticon");
    var p2 = document.getElementById("playlisticon2");

    var tracks = document.getElementById('tracks');

    p2.classList.remove('material-icons-round');
    p2.classList.add('preloader_circle');
    p2.classList.add("padd_mod");
    p2.innerHTML = "";

    var xhr = new XMLHttpRequest();
    xhr.open("DELETE", "process/remFromPlaylist?userid=" + userid + "&&songid=" + songid, true)
    xhr.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            var response = this.responseText;
            var pattern = /done/;
            if (response.match(pattern)) {
                var newCount = response.replace(/done/, 'Tracks: ');

                p2.classList.add("hide");
                p2.classList.add('material-icons-round');
                p2.classList.remove("padd_mod");
                p2.classList.remove('preloader_circle');
                p2.innerHTML = "playlist_add";

                p1.classList.remove("hide");

                tracks.innerHTML = newCount;

            }

        }
    }
    xhr.send();

}

function add_to_play(x, y, z) {

    var playlistid = y;
    var songid = x;
    var userid = z;
    var date = Date.now();

    var icon = document.getElementById('playlisticon');
    var icon2 = document.getElementById('playlisticon2');

    var tracks = document.getElementById('tracks');

    var xhttp = new XMLHttpRequest();
    xhttp.open('POST', 'process/addToPlaylist?playlistid=' + playlistid + '&&songid=' + songid + '&&userid=' + userid + '&&date=' + date, true);
    xhttp.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            var response = this.responseText;
            var pattern = /Done/;

            if (response.match(pattern)) {

                var newCount = response.replace(/Done/, 'Tracks: ');
                displaySMsg(response.replace(/\d*/g, ''));

                icon.classList.add("hide");
                icon2.classList.remove('hide');

                tracks.innerHTML = newCount;

                clearPlayForm();

            } else {
                displayFMsg(response);
            }
        }
    }
    xhttp.send();

}

function del_play(x, y) {

    var playid = x;
    var userid = y;
    var elem = document.getElementById('pedfull');

    var xhr = new XMLHttpRequest();
    xhr.open("DELETE", "process/delPlay?playid=" + playid + "&&userid=" + userid, true);
    xhr.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {

            pattern = /<div/;
            if (this.responseText.match(pattern)) {
                elem.innerHTML = this.responseText;
                setDimensions();
            }

        }
    }
    xhr.send();
}

function add_to_like(x, y, z = null) {

    var songid = x;
    var userid = y;
    var albumBoolean = z;
    var elem = document.getElementById('likeicon');
    var elem2 = document.getElementById('likeicon2');
    var elem3 = document.getElementById('elem3');
    var elem4 = document.getElementById('elem4');
    var date = Date.now();

    var xhttp = new XMLHttpRequest();
    if (albumBoolean == null) {
        xhttp.open('POST', 'process/addLike?songid=' + songid + '&&userid=' + userid + '&&date=' + date, true);
    } else {
        xhttp.open('POST', 'process/addLike?songid=' + songid + '&&userid=' + userid + '&&date=' + date + '&&albumBoolean=' + albumBoolean, true);
    }
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (albumBoolean == null) {
                elem.classList.add('hide');
                elem2.classList.remove('hide');

                setTimeout(() => {
                    swell.currentTime = 0.3;
                    swell.play();
                    elem2.classList.add('swell');
                    setTimeout(() => {
                        elem2.classList.remove('swell');
                        swell.currentTime = 0;
                    }, 1010);
                }, 10);
            } else {
                elem3.classList.add('hide');
                elem4.classList.remove('hide');

                setTimeout(() => {
                    swell.currentTime = 0.3;
                    swell.play();
                    elem4.classList.add('swell');
                    setTimeout(() => {
                        elem4.classList.remove('swell');
                        swell.currentTime = 0;
                    }, 1010);
                }, 10);
            }
        }
    };
    xhttp.send();

}

function rem_like(x, y, z = null) {

    var songid = x;
    var userid = y;
    var albumBoolean = z;
    var elem = document.getElementById('likeicon');
    var elem2 = document.getElementById('likeicon2');
    var elem3 = document.getElementById('elem3');
    var elem4 = document.getElementById('elem4');

    var xhttp = new XMLHttpRequest();
    if (albumBoolean == null) {
        xhttp.open('POST', 'process/remLike?songid=' + songid + '&&userid=' + userid, true);
    } else {
        xhttp.open('POST', 'process/remLike?songid=' + songid + '&&userid=' + userid + '&&albumBoolean=' + albumBoolean, true);
    }
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (albumBoolean == null) {
                elem2.classList.add('hide');
                elem.classList.remove('hide');
            } else {
                elem4.classList.add('hide');
                elem3.classList.remove('hide');
            }
        }
    };
    xhttp.send();

}


function uploadComment(x, y) {

    var userid = x;
    var songid = y;
    var pattern = /Comment upload failed/;
    var eD = document.getElementById('formerror');
    var date = Date.now()

    eD.classList.remove('hide');

    const commForm = document.getElementById('commForm');
    var body = document.getElementById('ccamain');
    var comment = document.getElementById('cFinput').value;
    comment = comment.trim(comment);

    if (comment == "") {
        return false
    } else {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', 'process/uploadComment?userid=' + userid + '&&songid=' + songid + '&&date=' + date, true);
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                if (response.match(pattern)) {
                    eD.innerHTML = response;
                    eD.classList.add('formerrorani');

                    error_remove();

                } else {
                    body.innerHTML = this.responseText;
                    clicker('comTime');
                }
            }
        };
        var data = new FormData(commForm);
        xhttp.send(data);

        return false

    }

}

function delNot(x, y) {

    var id = x;
    var user = y;
    var body = document.getElementById('nedfull');

    var xhttp = new XMLHttpRequest();
    xhttp.open('POST', 'process/delNotification?id=' + id + '&&user=' + user, true);
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            body.innerHTML = this.responseText;
            clicker('notTime');
            setDimensions();
        }
    };
    xhttp.send();

}


function rem_red_dot(x) {

    var a = document.getElementById('rD');
    var userid = x;

    a.classList.remove('red_dot');
    a.classList.remove('red_dot_adv');

    var xhtml = new XMLHttpRequest();
    xhtml.open('POST', 'process/seenNot?userid=' + userid, true);
    xhtml.send()


}

function dateParser(dbTime) {

    var currentTime = Date.now();

    var remTime = currentTime - dbTime;

    if (remTime > 0 && remTime <= 60000) {
        remTime = remTime / 1000;
        remTime = Math.floor(remTime);
        if (remTime == 1 || remTime == 0) {
            remTime = remTime + ' second ago';
        } else {
            remTime = remTime + ' seconds ago';
        }
    } else if (remTime > 60000 && remTime <= 3600000) {
        remTime = remTime / 60000;
        remTime = Math.floor(remTime);
        if (remTime == 1) {
            remTime = remTime + ' minute ago';
        } else {
            remTime = remTime + ' minutes ago';
        }
    } else if (remTime > 3600000 && remTime <= 86400000) {
        remTime = remTime / 3600000;
        remTime = Math.floor(remTime);
        if (remTime == 1) {
            remTime = remTime + ' hour ago';
        } else {
            remTime = remTime + ' hours ago';
        }
    } else if (remTime > 86400000) {
        remTime = remTime / 86400000;
        remTime = Math.floor(remTime);
        if (remTime == 1) {
            remTime = remTime + ' day ago';
        } else {
            remTime = remTime + ' days ago';
        }
    }

    final = remTime;

    return final;

}

function checkTime(x, y, z) {

    var dbTime = x;
    var elem = document.getElementsByClassName(y);
    var comid = z;
    var final = '';

    final = dateParser(dbTime);

    for (let index = 0; index < elem.length; index++) {
        const element = elem[index];

        if (index == comid) {
            element.innerHTML = final;
        }

    }

}

function checkTime2(time, elemName) {

    var elem = document.getElementById(elemName);

    elem.innerHTML = dateParser(time);

}

function clicker(x) {
    var elem = document.getElementsByClassName(x);

    for (let index = 0; index < elem.length; index++) {
        const element = elem[index];
        element.click();
    }

}

function newCT(x, y, z) {

    var dbTime = x;
    var elem = document.getElementsByClassName(y);
    var comid = z;
    var final = '';
    var currentTime = Date.now();

    var remTime = currentTime - dbTime;

    if (remTime > 0 && remTime <= 60000) {
        remTime = remTime / 1000;
        remTime = Math.floor(remTime);
        if (remTime == 1 || remTime == 0) {
            remTime = remTime + ' second ago';
        } else {
            remTime = remTime + ' seconds ago';
        }
    } else if (remTime > 60000 && remTime <= 3600000) {
        remTime = remTime / 60000;
        remTime = Math.floor(remTime);
        if (remTime == 1) {
            remTime = remTime + ' minute ago';
        } else {
            remTime = remTime + ' minutes ago';
        }
    } else if (remTime > 3600000 && remTime <= 86400000) {
        remTime = remTime / 3600000;
        remTime = Math.floor(remTime);
        if (remTime == 1) {
            remTime = remTime + ' hour ago';
        } else {
            remTime = remTime + ' hours ago';
        }
    } else if (remTime > 86400000) {
        remTime = remTime / 86400000;
        remTime = Math.floor(remTime);
        if (remTime == 1) {
            remTime = remTime + ' day ago';
        } else {
            remTime = remTime + ' days ago';
        }
    }

    final = remTime;

    for (let index = 0; index < elem.length; index++) {
        const element = elem[index];

        if (index == comid) {
            element.innerHTML = final;
        }

    }


}

function PremiumFade() {

    var errorDiv = document.getElementById('pE');

    var Topdata = document.createElement('div');
    Topdata.className = 'premiumError';
    var innerData = document.createElement('h4');
    innerData.className = 'pEtext';
    innerData.id = 'pET';
    innerData.textContent = "This feature is currently unavailable.";

    Topdata.appendChild(innerData);

    if (errorDiv.childElementCount > 3) {
        var firstNode = errorDiv.children[0];

        // checks if the node still exists
        if (errorDiv.contains(firstNode)) {
            errorDiv.removeChild(firstNode);
        }

    }

    errorDiv.appendChild(Topdata);

    setTimeout(() => {
        Topdata.classList.add('fade');
    }, 100);

    setTimeout(() => {
        Topdata.classList.remove('fade');

        setTimeout(() => {
            // checks if the node still exists before attempting to delete
            if (errorDiv.contains(Topdata)) {
                errorDiv.removeChild(Topdata);
            }
        }, 100);
    }, 5000);

}

function avgStream(x, y, z) {

    var elem = document.getElementById(x);
    var joined = y;
    var count = z;

    var date = Date.now();

    var calc1 = count * 35;
    var calc2 = date - joined;
    var calc3 = calc2 / 86400000;
    var calc4 = calc1 / calc3;

    if (calc4 == 0) {
        calc4 = 'Nil';
    } else if (calc4 > 0 && calc4 <= 1) {
        calc4 = calc4.toFixed(0) + ' sec(s)'
    } else if (calc4 > 1 && calc4 <= 60) {
        calc4 = calc4.toFixed(0) + ' sec(s)'
    } else if (calc4 > 60 && calc4 <= 3600) {
        calc4 = calc4 / 60;
        calc4 = calc4.toFixed(2) + ' min(s)'
    } else if (calc4 > 3600) {
        calc4 = calc4 / 3600;
        calc4 = calc4.toFixed(2) + ' hour(s)'
    }

    var final = calc4;

    elem.innerHTML = final;

}

function albumFirst(x) {

    var userid = x;
    var elem = document.getElementById('ualbumfull');
    var date = Date.now();

    var aN = document.getElementById('albumName').value;
    var aA = document.getElementById('albArtist').value;
    var aP = document.getElementById('albProd').value;
    var aG = document.getElementById('albGenre').value;
    var aY = document.getElementById('albYear').value;
    var aCA = document.getElementById('uacid').src;
    var i = document.getElementById('formerror');
    var z = document.getElementById('f');

    aN = aN.trim();
    aA = aA.trim();
    aP = aP.trim();
    aG = aG.trim();
    aY = aY.trim();

    i.classList.remove('hide');

    if (aN == "" && aA != "" && aP != "" && aG != "" && aY != "") {
        z.scrollIntoView();
        i.innerHTML = "Sorry, album name field cannot be empty";
        i.classList.add('lngtextfont');
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else if (aN != "" && aA == "" && aP != "" && aG != "" && aY != "") {
        z.scrollIntoView();
        i.innerHTML = "Sorry, album artist field cannot be empty";
        i.classList.add('lngtextfont');
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else if (aN != "" && aA != "" && aP == "" && aG != "" && aY != "") {
        z.scrollIntoView();
        i.innerHTML = "Sorry, album producer field cannot be empty";
        i.classList.add('lngtextfont');
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else if (aN != "" && aA != "" && aP != "" && aG == "" && aY != "") {
        z.scrollIntoView();
        i.innerHTML = "Sorry, album genre field cannot be empty";
        i.classList.add('lngtextfont');
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else if (aN != "" && aA != "" && aP != "" && aG != "" && aY == "") {
        z.scrollIntoView();
        i.innerHTML = "Sorry, album year field cannot be empty";
        i.classList.add('lngtextfont');
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else if (aN != "" && aA != "" && aP != "" && aG != "" && aY != "") {

        var xhtml = new XMLHttpRequest();
        xhtml.open('POST', 'process/ualbum1?userid=' + userid + '&&cA=' + aCA + '&&date=' + date, true);
        xhtml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                var response = this.responseText;
                var pattern = /div/;

                if (response.match(pattern)) {

                    elem.innerHTML = this.responseText;

                } else {

                    z.scrollIntoView();
                    i.innerHTML = response;
                    i.classList.add('formerrorani');
                    i.classList.add('lngtextfont');
                    document.getElementById('uacid').src = "Upload/Img/Profile/Default/cp/cp6.jpeg";

                    // error_remove();
                }

            }
        };
        var form = document.getElementById('ualbform');
        var data = new FormData(form)
        xhtml.send(data);

        return false
    } else {
        z.scrollIntoView();
        i.innerHTML = "Sorry, fields cannot be empty";
        i.classList.add('formerrorani');

        error_remove()
        return false
    }

}

function uploadalbcA(x) {

    var elem = document.getElementById('uacid');
    var i = document.getElementById('formerror');
    var icon = document.getElementById('uafci');
    var oldCA = x;

    icon.classList.remove('material-icons-round');
    icon.classList.add('preloader_circle');
    icon.classList.add('make_white');
    icon.innerHTML = "";

    var xhtml = new XMLHttpRequest();
    xhtml.open('POST', 'process/changeAlbCa?oldCA=' + oldCA, true);
    xhtml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            var response = this.responseText;
            var pattern = /i_worked/;

            if (response.match(pattern)) {

                response = response.replace('i_worked', 'mitunes/');

                elem.src = response;

                icon_error_remove();

            } else {

                i.innerHTML = response;
                i.classList.add('formerrorani');
                i.classList.add('lngtextfont');

                icon_error_remove();
                error_remove();
            }

        }
    };
    var form = document.getElementById('ualbform');
    var data = new FormData(form)
    xhtml.send(data);

    // this empties the value field
    var fileInput = document.getElementById('ualbcA');
    fileInput.value = '';

    delOldUpload(elem);

}

function delOldUpload(x) {

    var elem = x;
    var src = elem.src;
    var pattern = /tempCA/;

    if (src.match(pattern)) {
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', 'process/delOldUpload?file=' + src, true);
        xhttp.send();
    }

}

function icon_error_remove() {
    var icon = document.getElementById('uafci');

    icon.classList.add('material-icons-round');
    icon.classList.remove('preloader_circle');
    icon.classList.remove('make_white');
    icon.innerHTML = "add_a_photo";
}

function delAlbum(x, a, y) {

    var path = x;
    var artist = a;
    var userid = y;
    var elem = document.getElementById('ualbumfull');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process/delAlbum?path=' + path + '&&user=' + userid + '&&artist=' + artist, true);
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            elem.innerHTML = this.responseText;
        }
    }
    xhr.send()

}

function editets(x, y) {

    var icon = document.getElementById(x);
    var menu = document.getElementById(y);

    if (icon.innerHTML == "edit") {
        icon.innerHTML = "clear";
        menu.classList.remove('hide');
    } else if (icon.innerHTML == "clear") {
        icon.innerHTML = "edit";
        menu.classList.add('hide');
    }

}

function editAlbum(x, y, z) {

    var albN = x;
    var albA = y;
    var creator = z;
    var elem = document.getElementById('ualbumfull');

    var xhttp = new XMLHttpRequest();
    xhttp.open('POST', 'process/editalbum?albumName=' + albN + '&&artistName=' + albA + '&&creator=' + creator, true);
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            elem.innerHTML = this.responseText;

        }
    };
    xhttp.send();

}

function albumeFirst(x, y, z, a) {

    var albN = x;
    var albA = y;
    var creator = z;
    var folder = a;

    var elem = document.getElementById('ualbumfull');
    var date = Date.now();

    var aN = document.getElementById('albumName').value;
    var aA = document.getElementById('albArtist').value;
    var aP = document.getElementById('albProd').value;
    var aG = document.getElementById('albGenre').value;
    var aY = document.getElementById('albYear').value;
    var aCA = document.getElementById('uacid').src;
    var i = document.getElementById('formerror');
    var z = document.getElementById('f');

    aN = aN.trim();
    aA = aA.trim();
    aP = aP.trim();
    aG = aG.trim();
    aY = aY.trim();

    i.classList.remove('hide');


    if (aN == "" && aA != "" && aP != "" && aG != "" && aY != "") {
        z.scrollIntoView();
        i.innerHTML = "Sorry, album name field cannot be empty";
        i.classList.add('lngtextfont');
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else if (aN != "" && aA == "" && aP != "" && aG != "" && aY != "") {
        z.scrollIntoView();
        i.innerHTML = "Sorry, album artist field cannot be empty";
        i.classList.add('lngtextfont');
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else if (aN != "" && aA != "" && aP == "" && aG != "" && aY != "") {
        z.scrollIntoView();
        i.innerHTML = "Sorry, album producer field cannot be empty";
        i.classList.add('lngtextfont');
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else if (aN != "" && aA != "" && aP != "" && aG == "" && aY != "") {
        z.scrollIntoView();
        i.innerHTML = "Sorry, album genre field cannot be empty";
        i.classList.add('lngtextfont');
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else if (aN != "" && aA != "" && aP != "" && aG != "" && aY == "") {
        z.scrollIntoView();
        i.innerHTML = "Sorry, album year field cannot be empty";
        i.classList.add('lngtextfont');
        i.classList.add('formerrorani');

        error_remove()
        return false
    } else if (aN != "" && aA != "" && aP != "" && aG != "" && aY != "") {

        var xhtml = new XMLHttpRequest();
        xhtml.open('POST', 'process/ualbum2?aCa=' + aCA + '&&albumName=' + albN + '&&artistName=' + albA + '&&creator=' + creator + '&&date=' + date + '&&folder=' + folder, true);
        xhtml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                var response = this.responseText;
                var pattern = /div/;

                if (response.match(pattern)) {

                    elem.innerHTML = this.responseText;

                } else {

                    i.innerHTML = response;
                    i.classList.add('formerrorani');
                    i.classList.add('lngtextfont');

                    error_remove();
                }

            }
        };
        var form = document.getElementById('ualbform');
        var data = new FormData(form)
        xhtml.send(data);

        return false
    } else {
        z.scrollIntoView();
        i.innerHTML = "Sorry, fields cannot be empty";
        i.classList.add('formerrorani');

        error_remove()
        return false
    }

}

// drag & grop upload function

function effects() {

    const dropzone = document.getElementById('dropzone');

    dropzone.classList.add("effects");
}

function rem_effects() {

    const dropzone = document.getElementById('dropzone');

    dropzone.classList.remove("effects");
}

function upload_event(e, x, y) {

    var formdata, xhr;

    var albumName = x;
    var userid = y;
    var elem = document.getElementById('testBody');
    var text = document.getElementById('albsAddText');
    var icon = document.getElementById('albsAddicon');

    e.preventDefault();
    var files = e.dataTransfer.files;

    for (let index = 0; index < files.length; index++) {
        const file = files[index];

        file != undefined ? [
            formdata = new FormData(),
            // not a mistake to use [file] it makes it countable in the php file
            formdata.append('track', file),

            xhr = new XMLHttpRequest(),
            xhr.open("POST", 'process/uploadAlbumTrackFirst?albumName=' + albumName + '&&creator=' + userid + "&&count=1", true),
            xhr.onreadystatechange = function () {
                if (this.status == 200 && this.readyState == 4) {

                    pattern = /<div/;
                    response = this.responseText;

                    if (response.match(pattern)) {

                        text.innerHTML = "Track uploaded";
                        icon.innerHTML = 'done';
                        icon.classList.add('material-icons-round');
                        icon.classList.remove('preloader_circle_fit');

                        setTimeout(() => {
                            text.innerHTML = "add tracks to album";
                            icon.innerHTML = 'add';
                            icon.classList.add('material-icons-round');
                        }, 2000);

                        elem.innerHTML = this.responseText;

                    } else {

                        text.innerHTML = this.responseText;
                        icon.innerHTML = 'clear';
                        icon.classList.add('material-icons-round');
                        icon.classList.remove('preloader_circle');

                        setTimeout(() => {
                            text.innerHTML = "add tracks to album";
                            icon.innerHTML = 'add';
                            icon.classList.add('material-icons-round');
                        }, 2000);

                    }

                } else {
                    return false;
                }
            },
            xhr.send(formdata),

        ] : false;

    }

    rem_effects();

}

function albTrackFirstUpload(x, y) {

    var albumName = x;
    var userid = y;
    var elem = document.getElementById('testBody');

    var Form = document.getElementById('albTrackForm');
    var text = document.getElementById('albsAddText');
    var icon = document.getElementById('albsAddicon');

    text.innerHTML = "Adding track to album";
    icon.innerHTML = '';
    icon.classList.remove('material-icons-round');
    icon.classList.add('preloader_circle_fit');
    icon.innerHTML = '<div class="preloader_circle"></div>';

    var xhtml = new XMLHttpRequest();
    xhtml.open('POST', 'process/uploadAlbumTrackFirst?albumName=' + albumName + '&&creator=' + userid, true);
    xhtml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            pattern = /<div/;
            response = this.responseText;

            if (response.match(pattern)) {

                text.innerHTML = "Track uploaded";
                icon.innerHTML = 'done';
                icon.classList.add('material-icons-round');
                icon.classList.remove('preloader_circle_fit');

                setTimeout(() => {
                    text.innerHTML = "add tracks to album";
                    icon.innerHTML = 'add';
                    icon.classList.add('material-icons-round');
                }, 2000);

                elem.innerHTML = this.responseText;

            } else {

                text.innerHTML = this.responseText;
                icon.innerHTML = 'clear';
                icon.classList.add('material-icons-round');
                icon.classList.remove('preloader_circle');

                setTimeout(() => {
                    text.innerHTML = "add tracks to album";
                    icon.innerHTML = 'add';
                    icon.classList.add('material-icons-round');
                }, 2000);

            }

        }
    }
    var data = new FormData(Form);
    xhtml.send(data);

    // clears fileinput
    var fileInput = document.getElementById('track');
    fileInput.value = '';

}

function delAlbumTrack(x, y, z) {

    var trackName = x;
    var albumName = y;
    var creator = z;

    var i = document.getElementById('formerror');

    var elem = document.getElementById('testBody');

    var xhtml = new XMLHttpRequest();
    xhtml.open('POST', 'process/delAlbumTrack?trackName=' + trackName + '&&albumName=' + albumName + '&&creator=' + creator, true);
    xhtml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            var response = this.responseText;
            var pattern = /div/;

            if (response.match(pattern) || response == ' ') {

                elem.innerHTML = this.responseText;

            } else {

                i.innerHTML = response;
                i.classList.add('formerrorani');
                i.classList.add('lngtextfont');

                error_remove();
            }

        }
    }
    xhtml.send();

}

function changeAlbTrackCA(x, y, z) {

    var track = x;
    var album = y;
    var formid = z;
    var form = document.getElementById('trackForm' + formid);
    var elem = document.getElementById('trackCASelf' + formid);

    var cover = document.getElementById('cover' + formid);
    var big = document.getElementById('big' + formid);
    var text = document.getElementById('text' + formid);
    var icon = document.getElementById('icon' + formid);
    var main = document.getElementById('etimg' + formid);
    var imgicon = document.getElementById('trackCAicon' + formid);

    imgicon.classList.remove('material-icon-round');
    imgicon.classList.add('preloader_circle_white');
    imgicon.innerHTML = "";


    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process/changeAlbTrackCa?albumName=' + album + '&&trackName=' + track + '&&formid=' + formid, true);
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            var response = this.responseText;
            var pattern = /data:image/;

            //independent of response
            imgicon.classList.add('material-icon-round');
            imgicon.classList.remove('preloader_circle_white');
            imgicon.innerHTML = "add_a_photo";

            if (response.match(pattern)) {
                elem.src = this.responseText;
                main.src = this.responseText;

                cover.scrollIntoView();

                setTimeout(() => {
                    big.classList.add('bigGreen');
                    icon.innerHTML = 'done_all';
                    icon.classList.add('iconGreen');

                    setTimeout(() => {
                        text.innerHTML = 'Cover Art has been changed.';
                    }, 100);

                }, 500);

                alb_track_success_remove(z)

            } else {

                cover.scrollIntoView();

                setTimeout(() => {
                    big.classList.add('bigRed');
                    icon.innerHTML = 'clear';
                    icon.classList.add('iconRed');

                    setTimeout(() => {
                        text.innerHTML = response;
                    }, 100);

                }, 500);

                alb_track_fail_remove(z)

            }

        }
    }

    var data = new FormData(form)
    xhr.send(data);

    // this empties the value field
    var fileInput = document.getElementById('trackCA' + formid);
    fileInput.value = '';

}

function alb_track_fail_remove(z) {

    var cover = document.getElementById('cover' + z);
    var big = document.getElementById('big' + z);
    var text = document.getElementById('text' + z);
    var icon = document.getElementById('icon' + z);

    setTimeout(() => {
        text.innerHTML = '';

        setTimeout(() => {
            big.classList.remove('bigRed');
            icon.classList.remove('iconRed');
            icon.innerHTML = 'done';
        }, 100);

    }, 4000);

}

function alb_track_success_remove(z) {

    var cover = document.getElementById('cover' + z);
    var big = document.getElementById('big' + z);
    var text = document.getElementById('text' + z);
    var icon = document.getElementById('icon' + z);

    setTimeout(() => {
        text.innerHTML = '';

        setTimeout(() => {
            big.classList.remove('bigGreen');
            icon.classList.remove('iconGreen');
            icon.innerHTML = 'done';
        }, 100);

    }, 3000);

}

function albTrackEdit(x, y, z, a) {

    var formid = z;
    var albumName = y;
    var trackName = x;
    var creator = a;

    var cover = document.getElementById('cover' + z);
    var big = document.getElementById('big' + z);
    var text = document.getElementById('text' + z);
    var icon = document.getElementById('icon' + z);
    var body = document.getElementById('testBody');

    var tName = document.forms['trackForm' + formid]['trackName'].value;
    var fa = document.forms['trackForm' + formid]['featuredArtist'].value;
    var genre = document.forms['trackForm' + formid]['selgenre'].value;
    var year = document.forms['trackForm' + formid]['selyear'].value;
    var prod = document.forms['trackForm' + formid]['producer'].value;
    var des = document.forms['trackForm' + formid]['description'].value;

    tName = tName.trim();
    fa = fa.trim();
    prod = prod.trim();
    des = des.trim();

    if (tName == "" && fa != "" && genre != "" && year != "" && prod != "" && des != "") {

        cover.scrollIntoView();

        setTimeout(() => {
            big.classList.add('bigRed');
            icon.innerHTML = 'clear';
            icon.classList.add('iconRed');

            setTimeout(() => {
                text.innerHTML = "Sorry, Track Name is required.";
            }, 100);

        }, 500);

        alb_track_fail_remove(z)

        return false

    } else if (genre == "" && fa != "" && tName != "" && year != "" && prod != "" && des != "") {

        cover.scrollIntoView();

        setTimeout(() => {
            big.classList.add('bigRed');
            icon.innerHTML = 'clear';
            icon.classList.add('iconRed');

            setTimeout(() => {
                text.innerHTML = "Sorry, Track Genre is required.";
            }, 100);

        }, 500);

        alb_track_fail_remove(z)

        return false

    } else if (year == "" && fa != "" && genre != "" && tName != "" && prod != "" && des != "") {

        cover.scrollIntoView();

        setTimeout(() => {
            big.classList.add('bigRed');
            icon.innerHTML = 'clear';
            icon.classList.add('iconRed');

            setTimeout(() => {
                text.innerHTML = "Sorry, Track Year is required.";
            }, 100);

        }, 500);

        alb_track_fail_remove(z)

        return false

    } else if (prod == "" && fa != "" && genre != "" && year != "" && tName != "" && des != "") {

        cover.scrollIntoView();

        setTimeout(() => {
            big.classList.add('bigRed');
            icon.innerHTML = 'clear';
            icon.classList.add('iconRed');

            setTimeout(() => {
                text.innerHTML = "Sorry, Track Producer is required.";
            }, 100);

        }, 500);

        alb_track_fail_remove(z)

        return false

    } else if (genre != "" && year != "" && prod != "" && tName != "") {

        var xhtml = new XMLHttpRequest();
        xhtml.open('POST', 'process/editAlbumTrack?albumName=' + albumName + '&&trackName=' + trackName + '&&creator=' + creator, true);
        xhtml.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

                var pattern = /<div/;
                var response = this.responseText;

                if (response.match(pattern)) {

                    cover.scrollIntoView();

                    setTimeout(() => {
                        big.classList.add('bigGreen');
                        icon.innerHTML = 'done_all';
                        icon.classList.add('iconGreen');

                        setTimeout(() => {
                            text.innerHTML = "Track has been edited.";
                        }, 100);

                    }, 500);

                    alb_track_success_remove(z)

                    setTimeout(() => {
                        body.innerHTML = this.responseText;
                    }, 4000);

                    return false

                } else {

                    cover.scrollIntoView();

                    setTimeout(() => {
                        big.classList.add('bigRed');
                        icon.innerHTML = 'clear';
                        icon.classList.add('iconRed');

                        setTimeout(() => {
                            text.innerHTML = this.responseText;
                        }, 100);

                    }, 500);

                    alb_track_fail_remove(z)

                    return false

                }

            }
        }
        var form = document.getElementById('trackForm' + formid);
        var data = new FormData(form);
        xhtml.send(data);

        return false
    } else {

        cover.scrollIntoView();

        setTimeout(() => {
            big.classList.add('bigRed');
            icon.innerHTML = 'clear';
            icon.classList.add('iconRed');

            setTimeout(() => {
                text.innerHTML = "Sorry, fields can not be empty.";
            }, 100);

        }, 500);

        alb_track_fail_remove(z)


        return false
    }

}

function albumFinalUpload(x, a, y) {

    var albumName = x;
    var date = Date.now();
    var creator = y;
    var artist = a;
    var elem = document.getElementById('ualbumfull');

    var errorbody = document.getElementById('albFBody');
    var errorText = document.getElementById('albFUText');
    var erroricon = document.getElementById('albFUicon');
    var erroricon2 = document.getElementById('albFUicon2');

    errorText.innerHTML = 'Uploading...';
    erroricon.innerHTML = '';
    erroricon.classList.remove('material-icons-round');
    erroricon2.classList.add('preloader_circle');
    erroricon2.classList.add('make_white');

    var xhtml = new XMLHttpRequest();
    xhtml.open('POST', 'process/albumFinalUpload?albumName=' + albumName + '&&creator=' + creator + '&&artist=' + artist + '&&date=' + date, true);
    xhtml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            var pattern = /<div/
            var response = this.responseText;

            if (response.match(pattern)) {

                albFinalErrorRemove()
                elem.innerHTML = this.responseText;

            } else {

                errorText.innerHTML = this.responseText;
                errorText.classList.add('smallerFont');
                erroricon.innerHTML = 'clear';
                erroricon.classList.add('material-icons-round');
                erroricon2.classList.remove('preloader_circle');
                erroricon2.classList.remove('make_white');
                errorbody.classList.add('make_red');

                setTimeout(() => {
                    albFinalErrorRemove()
                }, 3000);

            }

        }
    }
    xhtml.send();

}

function albFinalErrorRemove() {

    var errorText = document.getElementById('albFUText');
    var erroricon = document.getElementById('albFUicon');
    var erroricon2 = document.getElementById('albFUicon2');
    var errorbody = document.getElementById('albFBody');

    errorText.innerHTML = 'Finish Upload';
    errorText.classList.remove('smallerFont');
    erroricon.innerHTML = 'done';
    erroricon.classList.add('material-icons-round');
    erroricon2.classList.remove('preloader_circle');
    erroricon2.classList.remove('make_white');
    errorbody.classList.remove('make_red');

}

function delAlbumFromProfile(x, a, y) {

    var songid = null;

    streams_count_reduce_from_album(x, a, y);

    uploads_count_reduce(x);

    remove_views(x, y, songid, a);

    dAFP(x, a, y);

}

function streams_count_reduce_from_album(x, a, y) {
    var userid = x;
    var albumName = y;
    var artist = a;
    var elem = document.getElementById('streams_count');

    var xhttp = new XMLHttpRequest();
    xhttp.open('POST', 'process/albumStreamCountReduce?albumName=' + albumName + '&&userid=' + userid + '&&artist=' + artist, true);
    xhttp.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            elem.innerHTML = this.responseText;
        }
    };
    xhttp.send();
}

function dAFP(x, a, y) {

    var id = x;
    var path = y;
    var artist = a;
    var elem = document.getElementById('uedfull');

    var xml = new XMLHttpRequest();
    xml.open('POST', 'process/delAlbumFromProfile.php?user=' + id + '&&path=' + path + '&&artist=' + artist, true);
    xml.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            elem.innerHTML = this.responseText;
            setDimensions();
        }
    }
    xml.send();

}

function Refresh() {
    return "Are you sure you want to reload ths page?";
}

function albumRefresh() {
    var elem = document.getElementById('automaticAlbDel');

    if (elem != null && elem != undefined) {
        elem.click();
    }

}

function Refresh_umusic() {
    var elem = document.getElementById('delUpload_Refresh');

    if (elem != null && elem != undefined) {
        elem.click();
    }
}

function delAlbum_Refresh(x, a, y) {

    var path = x;
    var artist = a;
    var userid = y;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process/delAlbum_Refresh?path=' + path + '&&user=' + userid + '&&artist=' + artist, true);
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //
        }
    }
    xhr.send()
}

function delUpload_Refresh(x) {

    path = x;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process/delUpload_Refresh?path=' + path, true);
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //
        }
    }
    xhr.send()
}

function internet_status() {

    window.addEventListener('offline', () => {

        var connectivity = document.getElementById('internetStatus');
        var connectivityStatus = document.getElementById('statetext');
        var connectivityStatusIcon = document.getElementById('stateicon');

        connectivity.classList.remove('hide');
        setTimeout(() => {
            connectivity.classList.add('fade');
            connectivityStatus.innerHTML = "Oops, your device is offline";
            connectivityStatusIcon.innerHTML = "wifi_off";
        }, 100);

        setTimeout(() => {
            connectivity.classList.remove('fade');
            connectivityStatus.innerHTML = "";
            connectivityStatusIcon.innerHTML = "";
            setTimeout(() => {
                connectivity.classList.add('hide');
            }, 100);
        }, 5000);

    });

    window.addEventListener('online', () => {

        var connectivity = document.getElementById('internetStatus');
        var connectivityStatus = document.getElementById('statetext');
        var connectivityStatusIcon = document.getElementById('stateicon');

        connectivity.classList.remove('hide');
        setTimeout(() => {
            connectivity.classList.add('fade');
            connectivityStatus.innerHTML = "You're back online";
            connectivityStatusIcon.innerHTML = "wifi";
        }, 100);

        setTimeout(() => {
            connectivity.classList.remove('fade');
            connectivityStatus.innerHTML = "";
            connectivityStatusIcon.innerHTML = "";
            setTimeout(() => {
                connectivity.classList.add('hide');
            }, 100);
        }, 5000);

    });

}

internet_status();

function lyrics_Fade() {
    const songSec = document.getElementById('song_sec');
    const lyricSec = document.getElementById('lyrics_sec');

    if (lyricSec.classList.contains('hide')) {
        lyricSec.style.position = 'absolute';
        lyricSec.style.marginTop = '-290px';

        lyricSec.classList.remove('hide');

        setTimeout(() => {
            lyricSec.classList.add('showSec');
            songSec.classList.add('removeSec');
        }, 250);

    } else {

        lyricSec.classList.remove('showSec');
        songSec.classList.remove('removeSec');

        setTimeout(() => {
            lyricSec.classList.add('hide');

            lyricSec.style.position = '';
            lyricSec.style.marginTop = '';
        }, 1001);
    }

}

function not_Refresher(x) {

    var user = x;

    var rD = red_dot_checker(user);

    var nC = not_content_checker(user);

    // figure out what to do if any of them fails
    if (rD && nC) {
        setTimeout(() => {
            not_Refresher(x);
        }, 5000);
    } else {
        not_Refresher(x);
    }

}

function red_dot_checker(x) {

    var elem = document.getElementById('nn');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process/notRefresher?userid=' + x + '&&request=1', true);
    xhr.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            elem.innerHTML = this.responseText;
        }
    }
    xhr.send();

    return true;

}

function not_content_checker(x) {

    var elem = document.getElementById('nedfull');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process/notRefresher?userid=' + x + '&&request=2', true);
    xhr.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            elem.innerHTML = this.responseText;

            clicker('notTime');
            setDimensions();
        }
    }
    xhr.send();

    return true;

}

function com_Refresher(x, y) {

    var elem = document.getElementById('realcca');
    var elem2 = document.getElementById('svmct');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process/comRefresher?songid=' + x + '&&userid=' + y, true);
    xhr.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            response = this.responseText;
            pattern = /No comment yet/;

            if (response.match(pattern)) {
                elem2.innerHTML = this.responseText;
            } else {
                elem.innerHTML = this.responseText;
            }

            clicker('comTime');

            setTimeout(() => {
                com_Refresher(x, y);
            }, 5000);
        }
    }
    xhr.send();

}

function clear_all_not(x) {
    var user = x
    var elem = document.getElementById('nedfull')

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process/clear_all_not?userid=' + user, true)
    xhr.onreadystatechange = () => {
        if (xhr.status == 200 && xhr.readyState == 4) {
            elem.innerHTML = xhr.responseText;
            setDimensions();
        }
    }
    xhr.send()
}

function show_album_details() {

    var pictureElement = document.getElementById('aDpic');
    var nameElement = document.getElementById('aDInfo');
    var fullDetailsElement = document.getElementById('aDFullInfo');

    if (pictureElement.classList.contains('half_it') == false) {
        nameElement.classList.add('fall_margin');
        setTimeout(() => {
            nameElement.classList.add('hide');
            pictureElement.classList.add('half_it');
            pictureElement.classList.add('col', 's4');
            fullDetailsElement.classList.add('col', 's8');
        }, 500);
    } else {
        pictureElement.classList.remove('half_it');
        pictureElement.classList.remove('col', 's4');
        fullDetailsElement.classList.remove('col', 's8');
        nameElement.classList.remove('hide');
        setTimeout(() => {
            nameElement.classList.remove('fall_margin');
        }, 500);
    }


}


var events = [];
var reason_for_click = '';
function album_mini(x, y, z, a, b, c) {

    reason_for_click = 'stop';

    var id = x;
    var file = y;
    var userid = a;
    var songid = z;
    var album = b;
    var albumid = c;
    var date = Date.now();

    var playBtn = document.getElementById('Play' + id);
    var pauseBtn = document.getElementById('Pause' + id);
    var playBtnAfter = document.getElementById('PlayAfter' + id);
    var stopBtn = document.getElementsByClassName('stop');
    var stopBtnSelf = document.getElementById('stop' + id);
    var pL = document.getElementById('Preloader' + id);
    var streams_elem = document.getElementById('streams_elem');

    // for speaker effects
    var speaker1 = document.getElementById('Speaker1' + id);
    var speaker2 = document.getElementById('Speaker2' + id);
    var speaker3 = document.getElementById('Speaker3' + id);
    var speakerDiv = document.getElementById('SpeakerDiv' + id);
    var trackNo = document.getElementById('trackNo4' + id);

    var playing = 0;
    var stage = 0;

    function speakerEffects() {

        if (playing == 1) {
            trackNo.classList.add('hide');
            speaker3.classList.add('hide');
            speaker1.classList.remove('hide');

            if (playing == 1) {
                setTimeout(() => {

                    speaker1.classList.add('hide');
                    speaker2.classList.remove('hide');

                    if (playing == 1) {
                        setTimeout(() => {

                            speaker2.classList.add('hide');
                            speaker3.classList.remove('hide');

                            if (playing == 1) {
                                setTimeout(() => {

                                    speakerEffects();

                                }, 500);
                            } else {
                                stage = 4;
                            }

                        }, 500);
                    } else {
                        stage = 3;
                    }

                }, 500);
            } else {
                stage = 2;
            }

        } else {
            stage = 1;
        }

    }

    function removeSpeakerEffects() {
        speaker1.classList.add('hide');
        speaker2.classList.add('hide');
        speaker3.classList.add('hide');
        speakerDiv.classList.add('hide');
        trackNo.classList.remove('hide');
    }

    function continueSpeakerEffects(x) {

        if (x == 1) {
            trackNo.classList.add('hide');
            speaker3.classList.add('hide');
            speaker1.classList.remove('hide');

            if (playing == 1) {
                setTimeout(() => {

                    speaker1.classList.add('hide');
                    speaker2.classList.remove('hide');

                    if (playing == 1) {
                        setTimeout(() => {

                            speaker2.classList.add('hide');
                            speaker3.classList.remove('hide');

                            if (playing == 1) {
                                setTimeout(() => {

                                    speakerEffects();

                                }, 500);
                            } else {
                                stage = 4;
                            }

                        }, 500);
                    } else {
                        stage = 3;
                    }

                }, 500);
            } else {
                stage = 2;
            }


        } else if (x == 2) {

            speaker1.classList.add('hide');
            speaker2.classList.remove('hide');

            if (playing == 1) {
                setTimeout(() => {

                    speaker2.classList.add('hide');
                    speaker3.classList.remove('hide');

                    if (playing == 1) {
                        setTimeout(() => {

                            speakerEffects();

                        }, 500);
                    } else {
                        stage = 4;
                    }

                }, 500);
            } else {
                stage = 3;
            }

        } else if (x == 3) {

            speaker2.classList.add('hide');
            speaker3.classList.remove('hide');

            if (playing == 1) {
                setTimeout(() => {

                    speakerEffects();

                }, 500);
            } else {
                stage = 4;
            }

        } else if (x == 4) {

            setTimeout(() => {

                speakerEffects();

            }, 500);

        }

    }

    // wavesurfer begins
    playBtn.classList.add('hide');
    playBtnAfter.classList.add('hide');
    pL.classList.remove('hide');

    var call = '#exSpectrum' + id;

    var wavesurfer = WaveSurfer.create({
        container: call
    });

    wavesurfer.on('ready', function () {

        for (let index = 0; index < stopBtn.length; index++) {
            const element = stopBtn[index];
            if (element != stopBtnSelf) {
                element.click();
            }
        }

        pL.classList.add('hide');
        pauseBtn.classList.remove('hide');

        wavesurfer.play();

        speakerDiv.classList.remove('hide');

        playing = 1;
        speakerEffects();

        pauseBtn.addEventListener('click', pBtn_am_func);
        events.push([pauseBtn, pBtn_am_func]);
        function pBtn_am_func() {

            wavesurfer.pause();

            playing = 0;

            pauseBtn.classList.add('hide');
            playBtnAfter.classList.remove('hide');

            if (timer != '') {
                timer.pause();
            }

        }

        playBtnAfter.addEventListener('click', pBtnA_am_func);
        events.push([playBtnAfter, pBtnA_am_func]);
        function pBtnA_am_func() {

            for (let index = 0; index < stopBtn.length; index++) {
                const element = stopBtn[index];
                if (element != stopBtnSelf) {
                    element.click();
                }
            }

            wavesurfer.play();

            playing = 1;
            speakerDiv.classList.remove('hide');

            playBtnAfter.classList.add('hide');
            pauseBtn.classList.remove('hide');

            playing = 1;
            continueSpeakerEffects(stage);

            if (timer != '') {
                timer.resume();
            }

        }

        stopBtnSelf.addEventListener('click', sBtnS_am_func);
        events.push([stopBtnSelf, sBtnS_am_func]);
        function sBtnS_am_func() {
            wavesurfer.empty();
            wavesurfer.pause();

            playing = 0;
            removeSpeakerEffects();

            pauseBtn.classList.add('hide');
            playBtnAfter.classList.add('hide');
            playBtn.classList.remove('hide');

            if (timer != '') {
                timer.pause();
                timer = '';
            }

            events.forEach((content, index) => {
                content[0].removeEventListener('click', content[1]);
            })
            events = [];

        }

        var Timer = function (callback, delay) {
            var timerId, start, remaining = delay;

            this.pause = function () {
                window.clearTimeout(timerId);
                remaining -= Date.now() - start;
            };

            this.resume = function () {
                start = Date.now();
                window.clearTimeout(timerId);
                timerId = window.setTimeout(callback, remaining);
            };

            this.resume();

        };

        var viewTime = Math.round((wavesurfer.getDuration() * 1000) * 0.15);
        var timer = new Timer(function () {
            var xhttp = new XMLHttpRequest();
            xhttp.open('POST', 'process/addView4Album.php?date=' + date + '&&userid=' + userid + '&&songid=' + songid + '&&albumid=' + albumid, true);
            xhttp.onreadystatechange = () => {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    var response = xhttp.responseText;
                    var pattern = /\d/;
                    if (response.match(pattern)) {
                        streams_elem.innerHTML = 'Total Streams: ' + xhttp.responseText;
                    }
                }
            };
            xhttp.send();

            // destroys old timer see other wavesurfer for reason
            timer = '';

        }, viewTime);

    });

    wavesurfer.on('finish', () => {
        wavesurfer.empty();
        wavesurfer.pause();

        playing = 0;
        removeSpeakerEffects();

        pauseBtn.classList.add('hide');
        playBtn.classList.remove('hide');

        events.forEach((content, index) => {
            content[0].removeEventListener('click', content[1]);
        })
        events = [];

    });

    wavesurfer.load(file);

}

var main_events = [];
var reservedPattern = [];
function album_main(y, z, a) {
    var fileid = y;
    var totalFiles = z;
    var album = a;

    var playBtn = document.getElementById('playMain');
    var pauseBtn = document.getElementById('pauseMain');
    var playBtnAfter = document.getElementById('playAfterMain');
    var pL = document.getElementById('preloaderMain');
    var sn = document.getElementById('skipNextMain');
    var sp = document.getElementById('skipPrevMain');
    var loop = document.getElementById('loopMain');
    var shuffle = document.getElementById('shuffleMain');
    var stopBtn = document.getElementsByClassName('stop');
    var stopBtnSelf = document.getElementById('stopMain');
    var subMenu = document.getElementById('fakeSubMenu');
    var statusText = document.getElementById('sT');

    var call = '#wavesurfer';

    statusText.innerHTML = "Playing";
    playBtn.classList.add('hide');
    pL.classList.remove('hide');

    // useful from 2nd track
    pauseBtn.classList.add('hide');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process/scandir4JS?path=' + album + '&&limit=' + fileid, true);
    xhr.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {

            var file = this.responseText;

            var realPauseBtn = document.getElementById('Pause' + fileid);
            var realPlayBtnAfter = document.getElementById('PlayAfter' + fileid);
            var realPlayBtn = document.getElementById('Play' + fileid);

            // to check if the first song is already playing
            if (fileid == 1 && realPauseBtn.classList.contains('hide') == false) {
                realPauseBtn.click();
                realPlayBtnAfter.classList.add('hide');
                playBtnAfter.classList.add('hide');
            }

            var wavesurfer = WaveSurfer.create({
                container: call
            });

            wavesurfer.on('ready', function () {

                pL.classList.add('hide');
                pauseBtn.classList.remove('hide');
                statusText.innerHTML = "Pause Album";


                pauseBtn.addEventListener('click', MainpBtn_am_func);
                main_events.push([pauseBtn, MainpBtn_am_func]);
                function MainpBtn_am_func() {
                    realPauseBtn.click();

                    pauseBtn.classList.add('hide');
                    playBtnAfter.classList.remove('hide');

                    statusText.innerHTML = 'Play Album';

                    // removed becaused it is present in the realPauseBtn
                }

                realPauseBtn.addEventListener('click', subpBtn_am_func);
                main_events.push([realPauseBtn, subpBtn_am_func]);
                function subpBtn_am_func() {

                    pauseBtn.classList.add('hide');
                    playBtnAfter.classList.remove('hide');

                    statusText.innerHTML = 'Play Album';

                    if (next_timer != '') {
                        next_timer.pause();
                    }

                }

                playBtnAfter.addEventListener('click', MainpABtn_am_func);
                main_events.push([playBtnAfter, MainpABtn_am_func]);
                function MainpABtn_am_func() {

                    realPlayBtnAfter.click();

                    playBtnAfter.classList.add('hide');
                    pauseBtn.classList.remove('hide');

                    statusText.innerHTML = "Pause Album";

                }

                realPlayBtnAfter.addEventListener('click', subpBtnAfter_am_func);
                main_events.push([realPlayBtnAfter, subpBtnAfter_am_func]);
                function subpBtnAfter_am_func() {

                    playBtnAfter.classList.add('hide');
                    pauseBtn.classList.remove('hide');

                    statusText.innerHTML = "Pause Album";

                    if (next_timer != '') {
                        next_timer.resume();
                    }

                }

                stopBtnSelf.addEventListener('click', MainsBtn_am_func);
                main_events.push([stopBtnSelf, MainsBtn_am_func]);
                function MainsBtn_am_func() {

                    if (reason_for_click == 'stop') {

                        realPauseBtn.click();

                        // could later make it continue from where you stop rather than start from beginning #because ur releasing the playBtn
                        pauseBtn.classList.add('hide');
                        playBtnAfter.classList.add('hide');
                        playBtn.classList.remove('hide');

                    }

                }

                loop.addEventListener('click', MainloopBtn_am_func);
                main_events.push([loop, MainloopBtn_am_func]);
                function MainloopBtn_am_func() {
                    if (loop.classList.contains('eclike')) {
                        loop.classList.remove('eclike');
                    } else {
                        loop.classList.add('eclike');
                    }
                }

                shuffle.addEventListener('click', MainshuffleBtn_am_func);
                main_events.push([shuffle, MainshuffleBtn_am_func]);
                function MainshuffleBtn_am_func() {

                    if (shuffle.classList.contains('eclike')) {

                        shuffle.classList.remove('eclike');

                        normalPattern = [];

                        for (let index = y; index <= totalFiles; index++) {
                            normalPattern.push(index);
                        }

                        function shuffle_func(array) {
                            return array.sort(() => 0.5 - Math.random());
                        }

                        shuffledPattern = shuffle_func(normalPattern);

                        // making sure that the current playing file always remains first
                        yIndex = shuffledPattern.lastIndexOf(y);
                        temp = shuffledPattern[yIndex];
                        shuffledPattern[yIndex] = shuffledPattern[0];
                        shuffledPattern[0] = temp;

                    } else {

                        shuffle.classList.add('eclike');

                    }

                    if (reservedPattern.length == 0) {
                        for (let index = 0; index < shuffledPattern.length; index++) {
                            var element = shuffledPattern[index];
                            reservedPattern.push(element);
                        }
                    }

                }

                sn.addEventListener('click', MainsnBtn_am_func);
                main_events.push([sn, MainsnBtn_am_func]);
                function MainsnBtn_am_func() {

                    if (shuffle.classList.contains('eclike')) {

                        if (loop.classList.contains('eclike') == false) {

                            if (y == totalFiles) {

                                if (next_timer != '') {
                                    next_timer.pause();
                                    next_timer = ''
                                }

                                y = 1
                                album_main(y, z, a);

                                main_events.forEach((content, index) => {
                                    content[0].removeEventListener('click', content[1]);
                                })
                                // empty the tray when done
                                main_events = [];

                            } else {

                                if (next_timer != '') {
                                    next_timer.pause();
                                    next_timer = ''
                                }

                                y = y + 1
                                album_main(y, z, a);

                                main_events.forEach((content, index) => {
                                    content[0].removeEventListener('click', content[1]);
                                })
                                // empty the tray when done
                                main_events = [];

                            }

                        } else {

                            if (y != totalFiles) {

                                if (next_timer != '') {
                                    next_timer.pause();
                                    next_timer = ''
                                }

                                y = y + 1
                                album_main(y, z, a);

                                main_events.forEach((content, index) => {
                                    content[0].removeEventListener('click', content[1]);
                                })
                                // empty the tray when done
                                main_events = [];

                            }

                        }

                    } else {

                        if (loop.classList.contains('eclike') == false) {

                            if (shuffledPattern.length != 0) {

                                if (next_timer != '') {
                                    next_timer.pause();
                                    next_timer = ''
                                }

                                next_song = shuffledPattern.shift();

                                if (next_song == y) {
                                    next_song = shuffledPattern.shift();
                                }

                                album_main(next_song, z, a);

                                main_events.forEach((content, index) => {
                                    content[0].removeEventListener('click', content[1]);
                                })
                                // empty the tray when done
                                main_events = [];

                            } else {

                                if (next_timer != '') {
                                    next_timer.pause();
                                    next_timer = ''
                                }

                                for (let index = 0; index < reservedPattern.length; index++) {
                                    const element = reservedPattern[index];
                                    shuffledPattern.push(element);
                                }

                                minElement = Math.min(...reservedPattern);
                                if (minElement != 1) {
                                    for (let index = minElement - 1; index >= 1; index--) {
                                        shuffledPattern.push(index);
                                        reservedPattern.push(index);
                                    }
                                }

                                next_song = shuffledPattern.shift();

                                if (next_song == y) {
                                    next_song = shuffledPattern.shift();
                                }

                                album_main(next_song, z, a);

                                main_events.forEach((content, index) => {
                                    content[0].removeEventListener('click', content[1]);
                                })
                                // empty the tray when done
                                main_events = [];

                            }

                        } else {

                            if (shuffledPattern.length != 0) {

                                if (next_timer != '') {
                                    next_timer.pause();
                                    next_timer = ''
                                }

                                next_song = shuffledPattern.shift();

                                if (next_song == y) {
                                    next_song = shuffledPattern.shift();
                                }

                                album_main(next_song, z, a);

                                main_events.forEach((content, index) => {
                                    content[0].removeEventListener('click', content[1]);
                                })
                                // empty the tray when done
                                main_events = [];

                            }

                        }

                    }

                }

                sp.addEventListener('click', MainspBtn_am_func);
                main_events.push([sp, MainspBtn_am_func]);
                function MainspBtn_am_func() {

                    if (shuffle.classList.contains('eclike')) {

                        // there is no specific funvtion action for loop because it deos same thing the only determinant is shuffle

                        if (y != 1) {

                            if (next_timer != '') {
                                next_timer.pause();
                                next_timer = ''
                            }

                            y = y - 1;
                            album_main(y, z, a);

                            main_events.forEach((content, index) => {
                                content[0].removeEventListener('click', content[1]);
                            })
                            // empty the tray when done
                            main_events = [];

                        }

                    } else {

                        prev_song = reservedPattern[(reservedPattern.lastIndexOf(y)) - 1];
                        shuffledPattern.unshift(y);

                        if (loop.classList.contains('eclike') == false) {

                            if (reservedPattern.lastIndexOf(y) != 0) {
                                if (next_timer != '') {
                                    next_timer.pause();
                                    next_timer = ''
                                }

                                album_main(prev_song, z, a);

                                main_events.forEach((content, index) => {
                                    content[0].removeEventListener('click', content[1]);
                                })
                                // empty the tray when done
                                main_events = [];
                            }

                        } else {

                            if (prev_song >= 0) {

                                if (next_timer != '') {
                                    next_timer.pause();
                                    next_timer = ''
                                }

                                album_main(prev_song, z, a);

                                main_events.forEach((content, index) => {
                                    content[0].removeEventListener('click', content[1]);
                                })
                                // empty the tray when done
                                main_events = [];

                            }

                        }

                    }

                }

                var Timer = function (callback, delay) {
                    var timerId, start, remaining = delay;

                    this.pause = function () {
                        window.clearTimeout(timerId);
                        remaining -= Date.now() - start;

                    };

                    this.resume = function () {
                        start = Date.now();
                        window.clearTimeout(timerId);
                        timerId = window.setTimeout(callback, remaining);

                    };

                    this.resume();

                };

                var next_timeout = (wavesurfer.getDuration() * 1000) + 500;
                var next_timer = new Timer(function () {

                    // if its active
                    if (shuffle.classList.contains('eclike') == false) {

                        if (shuffledPattern.length != 0) {

                            next_song = shuffledPattern.shift();

                            if (next_song == y) {
                                next_song = shuffledPattern.shift();
                            }

                            album_main(next_song, z, a);

                        } else {

                            if (loop.classList.contains('eclike') == false) {

                                for (let index = 0; index < reservedPattern.length; index++) {
                                    const element = reservedPattern[index];
                                    shuffledPattern.push(element);
                                }

                                minElement = Math.min(...reservedPattern);
                                if (minElement != 1) {
                                    for (let index = minElement - 1; index >= 1; index--) {
                                        shuffledPattern.push(index);
                                        reservedPattern.push(index);
                                    }
                                }

                                next_song = shuffledPattern.shift();

                                if (next_song == y) {
                                    next_song = shuffledPattern.shift();
                                }

                                album_main(next_song, z, a);

                            } else {

                                pauseBtn.classList.add('hide');
                                playBtn.classList.remove('hide');

                                statusText.innerHTML = 'Play Album';

                            }

                        }

                    } else {

                        if (y < totalFiles) {
                            y = y + 1;
                            album_main(y, z, a);
                        } else {

                            if (loop.classList.contains('eclike') == false) {


                                album_main(1, z, a);
                            } else {

                                pauseBtn.classList.add('hide');
                                playBtn.classList.remove('hide');

                                statusText.innerHTML = 'Play Album';

                            }

                        }

                    }

                    main_events.forEach((content, index) => {
                        content[0].removeEventListener('click', content[1]);
                    })
                    // empty the tray when done
                    main_events = [];

                    // destroying old timer because if you dont if will have a settimout with 0seconds and every click of the playbtn to resume timer will fire this XHR request
                    next_timer = '';

                }, next_timeout);

            });

            wavesurfer.load(file);
            realPlayBtn.click();

            reason_for_click = '';

        }
    }
    xhr.send();

}

function displaySMsg(msg) {

    var elem = document.getElementById('customerror');
    var body = document.getElementsByTagName('BODY')[0];

    body.style.overflow = "scroll";

    window.scrollTo(0, 0);

    elem.classList.remove('hide');
    elem.classList.add('ceani');
    elem.classList.add('scsuccess');
    elem.innerHTML = msg;

    setTimeout(() => {
        elem.innerHTML = '';
        elem.classList.add('hide');
        elem.classList.remove('ceani');
        elem.classList.remove('scsuccess');

        body.style.overflow = "hidden";
    }, 2500)
}

function displayFMsg(msg) {

    var body = document.getElementsByTagName('BODY')[0];
    var errorDiv = document.getElementById('cE');

    var Topdata = document.createElement('div');
    var innerData = document.createElement('h4');
    innerData.className = 'cEtext hide';
    innerData.id = 'cET';
    innerData.textContent = msg;

    Topdata.appendChild(innerData);

    if (errorDiv.childElementCount > 3) {
        var firstNode = errorDiv.children[0];

        // checks if the node still exists
        if (errorDiv.contains(firstNode)) {
            errorDiv.removeChild(firstNode);
        }

    }

    errorDiv.appendChild(Topdata);

    setTimeout(() => {
        body.style.overflow = "scroll";

        window.scrollTo(0, 0);
        innerData.classList.remove('hide');
        Topdata.classList.add('ceani');
        Topdata.classList.add('customerror');
    }, 100);

    setTimeout(() => {
        // checks if the node still exists before attempting to delete
        if (errorDiv.contains(Topdata)) {
            errorDiv.removeChild(Topdata);
        }
    }, 500000);

    return true;

}

function changeSpectrumStyle(x, y) {

    var style = x;
    var userid = y;

    var elemContainer = document.getElementById('sNOsubSpectrum');

    var wave = document.getElementById("wave_toggle");
    var line = document.getElementById("line_toggle");

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process/changeSpectrumStyle?user=' + userid + '&&newStyle=' + style, true);
    xhr.onreadystatechange = function () {
        if (xhr.status == 200 && xhr.readyState == 4) {
            var response = xhr.responseText;
            var pattern = /\<h4/;
            if (response.match(pattern)) {

                elemContainer.innerHTML = response;

                if (wave.textContent == "toggle_on") {
                    wave.innerHTML = "toggle_off";
                    line.innerHTML = "toggle_on";
                } else if (line.textContent == "toggle_on") {
                    line.innerHTML = "toggle_off";
                    wave.innerHTML = "toggle_on";
                }

                displaySMsg('Spectrum change successful.');

            } else {
                displayFMsg('Spectrum change successful.');
            }

        }
    }
    xhr.send();

}

var Animated = [];
function fancyAni(x) {

    if (Animated[0] != undefined) {

        if (Animated[0].length == 3) {

            for (let index = 0; index < Animated[0].length; index++) {
                const element = Animated[0][index];
                if (index == 0) {
                    element.classList.remove('playRotate');
                    element.classList.remove('scaleDown');
                } else {
                    element.classList.remove('scaleDown');
                }
            }

        } else if (Animated[0].length == 2) {

            for (let index = 0; index < Animated[0].length; index++) {
                const element = Animated[0][index];
                if (index == 0) {
                    element.classList.remove('playRotate');
                    element.classList.remove('scaleDown');
                } else {
                    element.classList.remove('scaleDown');
                }
            }

        }

        Animated.pop();

    }

    var upperDivider = document.getElementById('divider' + (x - 1));
    var lowerDivider = document.getElementById('divider' + x);
    var elemBody = document.getElementById('pCData' + x);

    var extraElems = document.getElementsByClassName('pCData');
    var extraDividers = document.getElementsByClassName('playDividers');

    elemBody.classList.remove('scaleDown');

    setTimeout(() => {

        elemBody.classList.add("playRotate");

        // cant use foreach because the returned object is not a list
        for (let index = 0; index < extraElems.length; index++) {
            var element = extraElems[index];
            if (element != elemBody) {
                element.classList.add('scaleDown');
            } else {
                element.classList.remove('scaleDown');
            }
        }

        if (upperDivider != undefined && upperDivider != null && lowerDivider != undefined && lowerDivider != null && elemBody != undefined && elemBody != null) {

            for (let index = 0; index < extraDividers.length; index++) {
                var element = extraDividers[index];
                if (element != upperDivider && element != lowerDivider) {
                    element.classList.add('scaleDown');
                } else {
                    element.classList.remove('scaleDown');
                }
            }

        } else {

            for (let index = 0; index < extraDividers.length; index++) {
                var element = extraDividers[index];
                if (element != lowerDivider) {
                    element.classList.add('scaleDown');
                } else {
                    element.classList.remove('scaleDown');
                }
            }

        }

        if (upperDivider != null && upperDivider != undefined) {
            Animated.push([elemBody, upperDivider, lowerDivider])
        } else {
            Animated.push([elemBody, lowerDivider])
        }

    }, 301);

}

pm_events = [];
function playlist_mini(a, b, c, d) {

    var id = a;
    var file = b;
    file = file.replace('C:/xampp/htdocs/Websites/mitunes/', '');
    var songid = c;
    var userid = d;
    var date = Date.now();

    // thsi is used to retrigger this function when it is called again when another song is already playing
    var pCData = document.getElementById('pCData' + id);

    var playBtn = document.getElementById('playlistplayBtn' + id);
    var playBtnAfter = document.getElementById('playlistplayBtnAfter' + id);
    var pauseBtn = document.getElementById('playlistpauseBtn' + id);
    var stopBtnSelf = document.getElementById('stop' + id);
    var stopBtn = document.getElementsByClassName('stop');

    var moreIcon = document.getElementById('moreIcon' + id);
    var pL = document.getElementById('playPreloader' + id);

    // make the decision on what the user pressed for

    if (playBtn.classList.contains('pressed') == false && playBtnAfter.classList.contains('pressed') == false && pauseBtn.classList.contains('pressed') == false) {

        playBtn.classList.add('pressed');
        moreIcon.classList.add('hide');
        pL.classList.remove('hide');

        var call = '#playSpectrum' + id;

        var wavesurfer = WaveSurfer.create({
            container: call
        });

        wavesurfer.on('ready', function () {

            fancyAni(id);

            pL.classList.add('hide');
            moreIcon.classList.remove('hide');

            reason_for_click = 'stop';
            for (let index = 0; index < stopBtn.length; index++) {
                const element = stopBtn[index];
                if (element != stopBtnSelf) {
                    element.click();
                }
            }
            wavesurfer.play();

            var Timer = function (callback, delay) {
                var timerId, start, remaining = delay;

                this.pause = function () {
                    window.clearTimeout(timerId);
                    remaining -= Date.now() - start;
                };

                this.resume = function () {
                    start = Date.now();
                    window.clearTimeout(timerId);
                    timerId = window.setTimeout(callback, remaining);
                };

                this.resume();

            };

            var viewTime = Math.round((wavesurfer.getDuration() * 1000) * 0.15);
            var timer = new Timer(function () {
                var xhttp = new XMLHttpRequest();
                xhttp.open('POST', 'process/addView.php?date=' + date + '&&userid=' + userid + '&&songid=' + songid, true);
                xhttp.send();

                // destroying old timer because if you dont if will have a settimout with 0seconds and every click of the playbtn to resume timer will fire this XHR request
                timer = '';

            }, viewTime);

            pauseBtn.addEventListener('click', pm_pause);
            pm_events.push([pauseBtn, pm_pause]);
            function pm_pause() {
                // i dont feel like writing a condition to check the one to remove
                playBtnAfter.classList.remove('pressed');
                playBtn.classList.remove('pressed');

                pauseBtn.classList.add('pressed');

                if (timer != '') {
                    timer.pause();
                }

                wavesurfer.pause();
            };

            playBtnAfter.addEventListener('click', pm_playAfter);
            pm_events.push([playBtnAfter, pm_playAfter]);
            function pm_playAfter() {
                reason_for_click = 'stop';
                for (let index = 0; index < stopBtn.length; index++) {
                    const element = stopBtn[index];
                    if (element != stopBtnSelf) {
                        element.click();
                    }
                }

                playBtnAfter.classList.add('pressed');
                pauseBtn.classList.remove('pressed');

                wavesurfer.play();

                if (timer != '') {
                    timer.resume();
                }
            };

            stopBtnSelf.addEventListener('click', pm_stop);
            pm_events.push([stopBtnSelf, pm_stop]);
            function pm_stop() {
                wavesurfer.empty();
                wavesurfer.pause();

                playBtnAfter.classList.remove('pressed');
                pauseBtn.classList.add('pressed');

                if (timer != '') {
                    timer.pause();
                }
            };

        });

        wavesurfer.on('finish', function () {
            wavesurfer.pause();
            playBtn.classList.remove('pressed');
            pauseBtn.classList.add('pressed');

            pm_events.forEach((content, index) => {
                content[0].removeEventListener('click', content[1]);
            });

            // remove the animation effect when done.
        });

        wavesurfer.load(file);

    } else if ((playBtn.classList.contains('pressed') == true && playBtnAfter.classList.contains('pressed') == false && pauseBtn.classList.contains('pressed') == false) || (playBtn.classList.contains('pressed') == true && playBtnAfter.classList.contains('pressed') == true && pauseBtn.classList.contains('pressed') == false)) {

        pauseBtn.click();

    } else if (playBtn.classList.contains('pressed') == false && playBtnAfter.classList.contains('pressed') == false && pauseBtn.classList.contains('pressed') == true) {

        playBtnAfter.click();

    } else if (playBtn.classList.contains('pressed') == false && playBtnAfter.classList.contains('pressed') == true && pauseBtn.classList.contains('pressed') == false) {
        pauseBtn.click();
    } else if (playBtn.classList.contains('pressed') == true && playBtnAfter.classList.contains('pressed') == false && pauseBtn.classList.contains('pressed') == true) {

        if (pauseBtn.classList.remove('pressed') && playBtn.classList.remove('pressed')) {
            pCData.click();
        }

    }

}

function picBtn() {

    var mainbody = document.getElementById('playCon');

    if (mainbody != undefined && mainbody != null) {

        var pid = document.getElementById('pid').textContent;

        var prev = document.getElementById('prev');
        var pSpan = document.getElementById('prevSpan');

        var current = document.getElementById('current');
        var cSpan = document.getElementById('currentSpan');

        var next = document.getElementById('next');
        var nSpan = document.getElementById('nextSpan');

        prev.onclick = () => {
            // id is the song playing
            var id = pSpan.textContent;

            if (id != 'null') {

                var elem = document.getElementById('pCData' + id);

                elem.click();

                // // the order is important next, current, prev cause after each statement the value of the src tag changes so you need to first swap pics before it 
                // // changes

                next.src = current.src;
                nSpan.innerHTML = parseInt(id) + 1;

                current.src = prev.src;
                cSpan.innerHTML = id;


                // id+1 in the AJAX because $a in the playlists page starts from zero
                var xhr = new XMLHttpRequest();
                xhr.open('get', 'process/swapImages?direction=backwards&&id=' + (parseInt(id) + 1) + '&&pid=' + pid, true);
                xhr.onreadystatechange = function () {
                    if (this.status == 200 && this.readyState == 4) {

                        prev.src = JSON.parse(this.responseText).img;
                        pSpan.innerHTML = JSON.parse(this.responseText).no;

                    }
                }
                xhr.send();


            } else {
                // 
            }

        }

        current.onclick = () => {
            // id is the song playing
            var id = cSpan.textContent;

            if (id != 'null') {

                var elem = document.getElementById('pCData' + id);

                elem.click();

            } else {
                // 
            }

        }

        next.onclick = () => {
            // id is the song playing
            var id = nSpan.textContent;

            if (id != 'null') {

                var elem = document.getElementById('pCData' + id);

                elem.click();

                prev.src = current.src;
                pSpan.innerHTML = parseInt(id) - 1;

                current.src = next.src;
                cSpan.innerHTML = id;

                // id+1 in the AJAX because $a in the playlists page starts from zero
                var xhr = new XMLHttpRequest();
                xhr.open('get', 'process/swapImages?direction=forwards&&id=' + (parseInt(id) + 1) + '&&pid=' + pid, true);
                xhr.onreadystatechange = function () {
                    if (this.status == 200 && this.readyState == 4) {

                        nSpan.innerHTML = JSON.parse(this.responseText).no;
                        next.src = JSON.parse(this.responseText).img;

                    }
                }
                xhr.send();


            } else {
                // 
            }

        }

    }

}
window.onload = picBtn();
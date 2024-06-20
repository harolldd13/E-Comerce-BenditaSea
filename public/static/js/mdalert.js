var base = location.protocol + '//' + location.host;
var md_alert_dom, md_alert_inside, md_alert_content, md_alert_footer_other_btns;

document.addEventListener('DOMContentLoaded', function () {
    md_alert_dom = document.getElementById('md_alert_dom');
    md_alert_inside = document.getElementById('md_alert_inside');
    md_alert_content = document.getElementById('md_alert_content');
    md_alert_footer_other_btns = document.getElementById('md_alert_footer_other_btns');

    var md_alert_btn_close = document.getElementById('md_alert_btn_close');
    if (md_alert_btn_close) {
        md_alert_btn_close.addEventListener('click', function (e) {
            e.preventDefault();
            md_alert_status('hide');
        });
    }
});

function mdalert(data) {
    if (!md_alert_content) return; // Verificar si md_alert_content existe

    md_alert_content.innerHTML = "";
    if (data) {
        var title = data.title ? data.title : 'MD ALERT';
        var content = '<h2>' + title + '</h2>';
        
        if (data.type) {
            content += '<div class="icon"><img src="' + base + '/static/images/icons/' + data.type + '.png"></div>';
        }

        var msg = data.msg ? data.msg : 'Error desconocido';
        content += '<h5>' + msg + '</h5>';

        if (data.msgs) {
            var messages = JSON.parse(data.msgs);
            if (messages.length > 0) {
                content += '<ul>';
                messages.forEach(function (element) {
                    content += '<li><i class="bi bi-bullseye"></i>' + element + '</li>';
                });
                content += '</ul>';
            }
        }

        var actions_btns = "";
        if (data.actions) {
            var actions = JSON.parse(data.actions);
            if (actions.length > 0) {
                actions.forEach(function (element) {
                    if (element.url) {
                        actions_btns += '<a href="' + element.url + '" class="btn btn-' + element.type + '">' + element.type + '</a>';
                    } else {
                        actions_btns += '<a href="#" onclick="' + element.callback + '(' + element.params + '); return false;" class="btn btn-' + element.type + '">' + element.type + '</a>';
                    }
                });
            }
        }

        if (data.additional) {
            var additionals = JSON.parse(data.additional);
            if (additionals.hideclose) {
                var md_alert_btn_close = document.getElementById('md_alert_btn_close');
                if (md_alert_btn_close) {
                    md_alert_btn_close.style.display = 'none';
                }
            }
        }

        if (md_alert_footer_other_btns) {
            md_alert_footer_other_btns.innerHTML = actions_btns;
        }
        md_alert_content.innerHTML = content;
        md_alert_status('show');
    }
}

function md_alert_status(status) {
    if (!md_alert_dom || !md_alert_inside) return; // Verificar si md_alert_dom y md_alert_inside existen

    if (status == "show") {
        document.getElementsByTagName('body')[0].style.overflow = "hidden";
        var wrapper = document.getElementsByClassName('wrapper')[0];
        if (wrapper) {
            wrapper.classList.add('blur');
        }
        md_alert_dom.style.display = "flex";
        md_alert_dom.classList.remove('md_alert_animation_hide');
        md_alert_dom.classList.add('md_alert_animation_show');
        md_alert_inside.classList.add('scale_animation');
    }
    if (status == "hide") {
        document.getElementsByTagName('body')[0].style.overflow = "";
        var wrapper = document.getElementsByClassName('wrapper')[0];
        if (wrapper) {
            wrapper.classList.remove('blur');
        }
        md_alert_dom.style.display = "none";
        md_alert_dom.classList.add('md_alert_animation_hide');
        md_alert_dom.classList.remove('md_alert_animation_show');
        md_alert_inside.classList.remove('scale_animation');
    }
}


function submit_form(element, id_form, num = 0, urlplus = '', draging = false, confirm = false,loader = '',other_url ='') {

    if (confirm == true) {
        var message = $(element).data('message');
        if (!message) {
            message = 'Yakin akan melanjutkan aksi?';
        }

        Swal.fire({
            html: message,
            icon: 'question',
            showCancelButton: true,
            buttonsStyling: !1,
            confirmButtonText: "Lanjutkan",
            customClass: {
                confirmButton: css_btn_confirm,
                cancelButton: css_btn_cancel
            },
            reverseButtons: true
        }).then((function (t) {
            if (t.isConfirmed) {
                proses_form(element, id_form, num, urlplus, draging,loader, other_url)
            }
        }));
    } else {
        proses_form(element, id_form, num, urlplus, draging,loader, other_url)
    }
}

function proses_form(element, id_form, num, urlplus = '', draging = false,loader = '',other_url ='') {
    if (draging == true) {
        var drag = document.getElementById('sistem_drag');
        var filter = document.getElementById('sistem_filter');
    }
    // console.log('ok');
    var text_button = document.getElementById(element.id).innerHTML;
    if (other_url != '') {
        var url = other_url;
    }else{
        var url = $(id_form).attr('action') + urlplus;
    }
    
    var method = $(id_form).attr('method');
    // console.log(url);
    var form = $('form')[num];
    var form_data = new FormData(form);
    var editor = $(element).data('editor');
    var method_editor = $(element).data('method_editor');
    if (editor) {
        let array = editor.split(",");
        for (var a = 0; a < array.length; a++) {
            form_data.append(array[a], window['my'+array[a]].getData($("#"+array[a]).val()));
            // console.log(array[a]);
        }
       
    }

    // console.log(url, method, form, form_data);
    $.ajax({
        url: url,
        method: method,
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        beforeSend: function () {
            if (loader == '') {
                 $('#' + element.id).prop('disabled', true);
                $('#' + element.id).html('Tunggu Sebentar...');
            }else{
                 $('#' + element.id).prop('disabled', true);
                $('#' + element.id).html(loader);
            }
           


        },
        success: function (data) {
            $('.fadedin').remove();
            if (data.load != null) {
                if (data.load.loading_page == true) {
                    // KTApp.showPageLoading();
                    // console.log('loading');
                    for (var a = 0; a < data.load.length; a++) {
                        $(data.load[a].parent).load(data.load[a].reload);
                       
                    }
                }else{
                    for (var a = 0; a < data.load.length; a++) {
                        $(data.load[a].parent).load(data.load[a].reload);
                    }
                }
                
                
                // document.body.style.overflowY = 'scroll'
            }
            $('#' + element.id).prop('disabled', false);
            $('#' + element.id).html(text_button);

            if (data.status == 200 || data.status == true) {
                if (draging == true) {
                    drag.classList.add('d-none');
                    filter.classList.remove('d-none');
                }
                var icon = 'success';
            } else {
                var icon = 'warning';
            }

            if (data.page_to) {
                var page_active = false;
                var menu = false;
                if (data.page_to.active == true) {
                    page_active = data.page_to.active;
                    menu = true;
                }
                page_red_to(data.page_to.page,page_active,menu);
            }
            if (data.input) {
                    if (data.input.id) {
                         if (data.input.password) {
                            $(data.input.id).find("input[type=password]").val("");
                        }
                        if (data.input.text) {
                            $(data.input.id).find("input[type=text]").val("");
                        }
                        if (data.input.number) {
                            $(data.input.id).find("input[type=number]").val("");
                        }
                        if (data.input.textarea) {
                            $(data.input.id).find("textarea").val("");
                        }

                        if (data.input.all) {
                            $(data.input.id + ' input[type=text]').val("");
                            $(data.input.id + ' input[type=password]').val("");
                            $(data.input.id + ' input[type=number]').val("");
                            $(data.input.id + ' select').val("");
                            $(data.input.id + ' textarea').val("");
                        }
                    }else{
                         if (data.input.password) {
                            $(id_form).find("input[type=password]").val("");
                        }
                        if (data.input.text) {
                            $(id_form).find("input[type=text]").val("");
                        }
                        if (data.input.number) {
                            $(id_form).find("input[type=number]").val("");
                        }
                        if (data.input.textarea) {
                            $(id_form).find("textarea").val("");
                        }
                        if (data.input.file) {
                            $(id_form).find("input[type=file]").value = null;
                        }

                        if (data.input.all) {
                            $(id_form + ' input[type=text]').val("");
                            $(id_form + ' input[type=password]').val("");
                            $(id_form + ' input[type=number]').val("");
                            $(id_form + ' input[type=file]').value = null;
                            $(id_form + ' select').val("");
                            $(id_form + ' textarea').val("");
                        }
                    }
                   

                }
            if (data.modal != null) {
                $(data.modal.id).modal(data.modal.action);
            }

            if (data.canvas != null) {
                for (var a = 0; a < data.canvas.length; a++) {
                    $(data.canvas[a].id).offcanvas(data.canvas[a].action);
                }
            }
            if (data.alert) {
                Swal.fire({
                    html: data.alert.message,
                    icon: icon,
                    buttonsStyling: !1,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: css_btn_confirm
                    }
                }).then(function () {
                    if (data.redirect) {
                        location.href = data.redirect;
                    }
                    if (data.reload == true) {
                        location.reload();
                    }
                    

                    // if (data.page_to != '') {
                    //     user_page_to(data.page_to);
                    // }
                    if (data.element != null) {
                        const row = data.element.length;
                        for (var i = 0; i < row; i++) {
                            $(data.element[i].row).html(data.element[i].value);
                        }
                    }
                    if (data.remove != null) {
                        const rowk = data.remove.length;
                        for (var i = 0; i < rowk; i++) {
                            $(data.remove[i]).remove();
                        }                    }
                    if (data.tumpuk_bawah != null) {
                        const roww = data.tumpuk_bawah.length;
                        for (var i = 0; i < roww; i++) {
                            $(data.tumpuk_bawah[i].parent).append(data.tumpuk_bawah[i].value);
                        }
                    }
                    if (data.tumpuk_atas != null) {
                        const rowwu = data.tumpuk_atas.length;
                        for (var i = 0; i < rowwu; i++) {
                            $(data.tumpuk_atas[i].parent).append(data.tumpuk_atas[i].value);
                        }
                    }
                    
                });
            } else {
                if (data.required) {
                    // console.log(data.required);
                    const array = data.required.length;
                    for (var i = 0; i < array; i++) {
                        $('#' + data.required[i][0]).append('<span class="text-danger size-12 fadedin">' + data.required[i][1] + '</span>');
                        // console.log(data.required[i][0]);
                    }

                }

                if (data.redirect) {
                    location.href = data.redirect;
                }
                if (data.modal != null) {
                    $(data.modal.id).modal(data.modal.action);
                }

                if (data.reload == true) {
                    location.reload();
                }
            }
        }
    });
}

function hapus_data(e, id, url = '', text = '',reload = false) {
    e.preventDefault();
    var message = 'Anda yakin akan menghapus data ' + text + '? Data yang dihapus tidak akan bisa dipulihkan';
    const icon = 'question';
    Swal.fire({
        text: message,
        icon: icon,
        showCancelButton: true,
        buttonsStyling: !1,
        confirmButtonText: "Lanjutkan",
        customClass: {
            confirmButton: css_btn_confirm,
            cancelButton: css_btn_cancel
        },
        reverseButtons: true
    }).then((function (t) {
        if (t.isConfirmed) {
            $.ajax({
                url: BASE_URL + url,
                method: 'POST',
                data: { id: id },
                cache: false,
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    if (data.status == 200 || data.status == true) {
                        if (data.alert) {
                            Swal.fire({
                                html: data.alert.message,
                                icon: data.alert.icon,
                                buttonsStyling: !1,
                                confirmButtonText: 'Ok',
                                customClass: { confirmButton: css_btn_confirm }
                            }).then((function (t) {
                                if (t.isConfirmed) {
                                    var uri = window.location.search;
                                    if (reload == true) {
                                        location.reload();
                                    }else{
                                        $('#base_table').load(BASE_URL + page + uri + ' #reload_table');
                                         
                                        window.history.pushState('', '', BASE_URL + page + uri);
                                        
                                    }
                                }
                            }));
                        }else{
                            var uri = window.location.search;
                            if (reload == true) {
                                location.reload();
                            }else{
                                $('#base_table').load(BASE_URL + page + uri + ' #reload_table');
                                window.history.pushState('', '', BASE_URL + page + uri);
                            }
                        }
                        
                        
                    } else {
                        Swal.fire({
                            html: data.alert.message,
                            icon: 'warning',
                            buttonsStyling: !1,
                            confirmButtonText: 'Ok'
                        });
                    }
                }
            })
        }
    }))
}

function preview_image(element, url = '') {
     var modal = document.getElementById("modal_preview_all");
    var modalEmbed = document.getElementById("preview_embed");
    var modalImg = document.getElementById("preview_image");
    var captionText = document.getElementById("preview_caption");
    
    modalImg.classList.add('showin');
    modalImg.classList.remove('hidin');
    modalEmbed.classList.remove('showin');
    modalEmbed.classList.add('hidin');
    var capt = $(element).data('caption');
    modal.style.display = "block";
    if (url == '') {
        modalImg.src = element.src;
    }else{
        modalImg.src = url;
    }
    

    if (capt) {
        captionText.innerHTML = capt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("preview_close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() { 
        modal.style.display = "none";
    }
}

function preview_embed(element,  url) {
    var modal = document.getElementById("modal_preview_all");
    var modalEmbed = document.getElementById("preview_embed");
    var modalImg = document.getElementById("preview_image");
    var captionText = document.getElementById("preview_caption");
    
    modalImg.classList.add('hidin');
    modalImg.classList.remove('showin');
    modalEmbed.classList.remove('hidin');
    modalEmbed.classList.add('showin');
    
    var capt = $(element).data('caption');
    modal.style.display = "block";
    if (url == '') {
        modalEmbed.src = element.src;
    }else{
        modalEmbed.src = url;
    }
    

    if (capt) {
        captionText.innerHTML = capt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("preview_close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() { 
        modal.style.display = "none";
    }
}
function switch_modal(id, id2) {
    // var scrollBarWidth = window.innerWidth - document.body.offsetWidth;
    // $('body').css({
    //     marginRight: scrollBarWidth,
    //     overflow: 'hidden'
    // });

    $('#' + id).modal('hide');
    $('#' + id2).modal('show');

    document.getElementById("main_body").style.paddingRight = "0px";
}


function confirm_alert(element, e, message = 'Konfirmasi', url = null, method = 'POST', data, checkbox = false) {
    var data_param = $(element).data();
    // console.log(data_param.id);
    var href = $(element).attr('href');
    e.preventDefault();
    const icon = 'question';
    Swal.fire({
        text: message,
        icon: icon,
        showCancelButton: true,
        buttonsStyling: !1,
        confirmButtonText: "Lanjutkan",
        customClass: {
            confirmButton: css_btn_confirm,
            cancelButton: css_btn_cancel
        },
        reverseButtons: true
    }).then((function (t) {
        if (t.isConfirmed) {
            if (url != null) {
                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    cache: false,
                    dataType: 'json',
                    success: function (data) {
                        // console.log(data);
                        if (data.status == 200 || data.status == true) {
                            if (checkbox == true) {
                                $(this).prop('checked', true);
                            }
                            if (data.alert) {
                                Swal.fire({
                                    html: data.alert.message,
                                    icon: data.alert.icon,
                                    buttonsStyling: !1,
                                    confirmButtonText: 'Ok',
                                    customClass: { confirmButton: css_btn_confirm }
                                });
                            }
                            if (data.reload) {
                                location.reload();
                            }
                            if (data.redirect) {
                                location.href = data.redirect;
                            }
                        } else {
                            Swal.fire({
                                html: data.alert.message,
                                icon: 'warning',
                                buttonsStyling: !1,
                                confirmButtonText: 'Ok'
                            });
                        }
                    }
                })
            } else {
                var param = '';
                if (data_param) {
                    var i = 0;
                    Object.keys(data_param).forEach(key => {
                        i++;
                        if (i == 1) {
                            param += '?' + key + '=' + data_param[key];
                        } else {
                            param += '&' + key + '=' + data_param[key];
                        }
                    });
                }
                document.location.href = href + param;
            }
        }
    }))
}

function redirect(halaman) {
    location.href = BASE_URL + halaman;
}


function display_image(element,target,id_showin = '') {

    var id = $(element).prop('id');
    var file = document.getElementById(id).files[0];
    var reader  = new FileReader();
    reader.onload = function(e)  {
        $(target).prop('src',e.target.result);
     }
     // you have to declare the file loading
     reader.readAsDataURL(file);

     if (id_showin != '') {
        $(id_showin).removeClass('hidin');
        $(id_showin).addClass('showin');
     }
 }






function alert_sukses() {
    Swal.fire({
        html: 'Berhasil mendaftarkan pesanan',
        icon: 'success',
        buttonsStyling: !1,
        confirmButtonText: "Ok",
        customClass: {
            confirmButton: css_btn_confirm
        }
    })
    location.reload();
}

function alert_show(element, icon, message){
    Swal.fire({
        html: message,
        icon: icon,
        buttonsStyling: !1,
        confirmButtonText: "Ok",
        customClass: {
            confirmButton: css_btn_confirm
        }
    })
}

function compare_value(element, place) {
    var value = $(element).val();
    $(place).val(value);
}

function selisih_hari(tgl1,tgl2) {
    var tanggal1 = new Date(tgl1); // new Date() saja akan menghasilkan tanggal sekarang
    var tanggal2 = new Date(tgl2); // format tanggal YYYY-MM-DD, tahun-bulan-hari
    
    // set jam menjadi jam 12 malam, atau 00
    tanggal1.setHours(0, 0, 0, 0);
    tanggal2.setHours(0, 0, 0, 0);
    
    var selisih = Math.abs(tanggal1 - tanggal2);
    // Selisih akan dalam millisecond atau mili detik
    
    var hariDalamMillisecond = 1000 * 60 * 60 * 24; // 1000 * 1 menit * 1 jam * 1 hari
    
    var selisihTanggal = Math.round(selisih / hariDalamMillisecond);

    return selisihTanggal;
}


function get_tab(property, filter_tab,vector="",filter = "data-tab",id_prefix = false) {
    const base = document.querySelector(".base_tab");
    if (id_prefix != false) {
        target_div = document.querySelectorAll("#display_tab_"+id_prefix+" .zoom_filter");
    }else{
        target_div = document.querySelectorAll("#display_tab .zoom_filter");
    }
    
    base.querySelector(".active").classList.remove("active");
    $(property).addClass("active");

    target_div.forEach((div) => {
        let display_value = div.getAttribute(filter);
        if ((display_value == 'tab_'+filter_tab) || (filter_tab == "all")) {
            div.classList.remove("hidin");
            div.classList.add("showin");
        } else {
            div.classList.add("hidin");
            div.classList.remove("showin");
        }
    });
    if (vector != "") {
        const vector_bantuan = document.querySelector("#vector_bantuan");
        const tampil = document.querySelectorAll(".showin");
        if (tampil.length == 0) {
            vector_bantuan.classList.remove("hiding");
            vector_bantuan.classList.add("showin");
        } else {
            vector_bantuan.classList.add("hiding");
            vector_bantuan.classList.remove("showin");
        }
    }
    
}

function status_payment(status = 99)
{
    var data = [];
    data[0] = 'gagal';
    data[1] = 'pending';
    data[2] = 'menunggu';
    data[3] = 'sukses';
    if (data[status]) {
        return data[status];
    } else {
        return data;
    }
}

function sts_penarikan(status = 99)
{
    var data = [];
    data[0] = 'menunggu';
    data[1] = 'sukses';
    data[2] = 'gagal';
    if (data[status]) {
        return data[status];
    } else {
        return data;
    }
}

function updateDisplay(base, value) {
    // Display the CKEditor value in a separate div
    document.querySelector(base).innerText = value;
}

function embed_youtube(url) {
    const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
    const match = url.match(regExp);

    if(match && match[2].length === 11){
        return "https://www.youtube.com/embed/"+ match[2];
    }else{
        return null;
    }
}
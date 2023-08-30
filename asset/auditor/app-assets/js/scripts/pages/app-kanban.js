var quillEl;
$(function () {
  ("use strict");

  var boards,
    openSidebar = true,
    kanbanWrapper = $(".kanban-wrapper"),
    sidebar = $(".update-item-sidebar"),
    datePicker = $("#due-date"),
    select2 = $(".select2"),
    commentEditor = $(".comment-editor"),
    addNewForm = $(".add-new-board"),
    updateItemSidebar = $(".update-item-sidebar"),
    addNewInput = $(".add-new-board-input");

  var assetPath = "/data/auditor/kertas_kerja/";
  var assetBoard = (site_url = "https://e-office.sumedangkab.go.id/");
  var assetPegawai = "/data/foto/pegawai/";
  if ($("body").attr("data-framework") === "laravel") {
    assetPath = $("body").attr("data-asset-path");
  }

  // Get Data
  $.ajax({
    type: "GET",
    dataType: "json",
    async: false,
    url: assetBoard + "auditor/get_kanban/" + id_penugasan + "/" + id_member,
    // data: [{ id_penugasan: id_penugasan, id_member: id_member }],
    success: function (data) {
      boards = data;
    },
  });

  // Toggle add new input and actions
  addNewInput.toggle();

  // datepicker init
  if (datePicker.length) {
    datePicker.flatpickr({
      monthSelectorType: "static",
      altInput: true,
      altFormat: "j F, Y",
      dateFormat: "Y-m-d",
    });
  }

  // select2
  if (select2.length) {
    function renderLabels(option) {
      if (!option.id) {
        return option.text;
      }
      var $badge =
        "<div class='badge " +
        $(option.element).data("color") +
        " rounded-pill'> " +
        option.text +
        "</div>";

      return $badge;
    }

    select2.each(function () {
      var $this = $(this);
      $this.wrap("<div class='position-relative'></div>").select2({
        placeholder: "Select Label",
        dropdownParent: $this.parent(),
        templateResult: renderLabels,
        templateSelection: renderLabels,
        escapeMarkup: function (es) {
          return es;
        },
      });
    });
  }

  // Comment editor
  if (commentEditor.length) {
    quillEl = new Quill(".comment-editor", {
      modules: {
        toolbar: ".comment-toolbar",
      },
      placeholder: "Tambahkan Komentar... ",
      theme: "snow",
    });
  }

  // Render board dropdown
  function renderBoardDropdown() {
    return "";
    return (
      "<div class='dropdown'>" +
      feather.icons["more-vertical"].toSvg({
        class: "dropdown-toggle cursor-pointer font-medium-3 me-0",
        id: "board-dropdown",
        "data-bs-toggle": "dropdown",
        "aria-haspopup": "true",
        "aria-expanded": "false",
      }) +
      "<div class='dropdown-menu dropdown-menu-end' aria-labelledby='board-dropdown'>" +
      "<a class='dropdown-item delete-board' href='#'> " +
      feather.icons["trash"].toSvg({ class: "font-medium-1 align-middle" }) +
      "<span class='align-middle ms-25'>Delete</span></a>" +
      "<a class='dropdown-item' href='#'>" +
      feather.icons["edit"].toSvg({ class: "font-medium-1 align-middle" }) +
      "<span class='align-middle ms-25'>Rename</span></a>" +
      "<a class='dropdown-item' href='#'>" +
      feather.icons["archive"].toSvg({ class: "font-medium-1 align-middle" }) +
      "<span class='align-middle ms-25'>Archive</span></a>" +
      "</div>" +
      "</div>"
    );
  }

  // Render item dropdown
  function renderDropdown() {
    return "";
    return (
      "<div class='dropdown item-dropdown px-1'>" +
      feather.icons["more-vertical"].toSvg({
        class: "dropdown-toggle cursor-pointer me-0 font-medium-1",
        id: "item-dropdown",
        " data-bs-toggle": "dropdown",
        "aria-haspopup": "true",
        "aria-expanded": "false",
      }) +
      "<div class='dropdown-menu dropdown-menu-end' aria-labelledby='item-dropdown'>" +
      "<a class='dropdown-item' href='#'>Copy task link</a>" +
      "<a class='dropdown-item' href='#'>Duplicate task</a>" +
      "<a class='dropdown-item delete-task' href='#'>Delete</a>" +
      "</div>" +
      "</div>"
    );
  }
  // Render header
  function renderHeader(color, text) {
    return (
      "<div class='d-flex justify-content-between flex-wrap align-items-center mb-1'>" +
      "<div class='item-badges'> " +
      "<div class='badge rounded-pill badge-light-" +
      color +
      "'> " +
      text +
      "</div>" +
      "</div>" +
      renderDropdown() +
      "</div>"
    );
  }

  // Render avatar
  function renderAvatar(images, pullUp, margin, members, size) {
    var $transition = pullUp ? " pull-up" : "",
      member = members !== undefined ? members.split(",") : "";

    return images !== undefined
      ? images
          .split(",")
          .map(function (img, index, arr) {
            var $margin =
              margin !== undefined && index !== arr.length - 1
                ? " me-" + margin + ""
                : "";

            return (
              "<li class='avatar kanban-item-avatar avatar-sm" +
              " " +
              $transition +
              " " +
              $margin +
              "'" +
              "data-bs-toggle='tooltip' data-bs-placement='top'" +
              "title='" +
              member[index] +
              "'" +
              ">" +
              "<img src='" +
              assetPegawai +
              img +
              "' alt='Avatar' height='" +
              size +
              "'>" +
              "</li>"
            );
          })
          .join(" ")
      : "";
  }

  // Render footer
  function renderFooter(attachments, comments, assigned, members) {
    return (
      "<div class='d-flex justify-content-between align-items-center flex-wrap mt-1'>" +
      "<div> <span class='align-middle me-50'>" +
      feather.icons["paperclip"].toSvg({
        class: "font-medium-1 align-middle me-25",
      }) +
      "<span class='attachments align-middle'>" +
      attachments +
      "</span>" +
      "</span> <span class='align-middle'>" +
      feather.icons["message-square"].toSvg({
        class: "font-medium-1 align-middle me-25",
      }) +
      "<span>" +
      comments +
      "</span>" +
      "</span></div>" +
      "<ul class='avatar-group mb-0'>" +
      renderAvatar(assigned, true, 0, members, 28) +
      "</ul>" +
      "</div>"
    );
  }

  // Init kanban
  var kanban = new jKanban({
    element: ".kanban-wrapper",
    gutter: "15px",
    widthBoard: "250px", // width of the board
    responsivePercentage: true,
    dragItems: false,
    boards: boards,
    dragBoards: false,
    addItemButton: true,
    itemAddOptions: {
      enabled: list_at.includes(id_member), // add a button to board for easy item creation
      content: "+ Tambah Kertas Kerja", // text or html content of the board button
      class: "kanban-title-button btn btn-default btn-xs", // default class of the button
      footer: false, // position the button on footer
    },
    click: function (el) {
      var el = $(el);
      var flag = false;
      var title = el.attr("data-eid")
          ? el.find(".kanban-text").text()
          : el.text(),
        date = el.attr("data-due-date"),
        dateObj = new Date(date),
        year = dateObj.getFullYear(),
        dateToUse =
          dateObj.getDate() +
          " " +
          dateObj.toLocaleString("en", {
            month: "long",
          }) +
          ", " +
          year,
        label = el.attr("data-badge-text"),
        avatars = el.attr("data-assigned"),
        boardId = el.attr("data-eid");
        pembuat = el.attr("data-pembuat");
        pembuatId = el.attr("data-pembuatid");
      cover = el.attr("data-image")
        ? assetPath + "cover/" + el.attr("data-image")
        : "";

      if (el.find(".kanban-item-avatar").length) {
        el.find(".kanban-item-avatar").on("click", function (e) {
          e.stopPropagation();
        });
      }
      $(document).on("click", ".item-dropdown", function (e) {
        flag = true;
      });
      setTimeout(function () {
        if (flag === false) {
          sidebar.modal("show");
        }
      }, 50);

      sidebar.find("#title").val(title);
      sidebar.find("#board_id").val(boardId);
      sidebar.find("#board_ida").val(boardId);
      sidebar.find("#board_idan").val(boardId);
      sidebar.find("#board_idal").val(boardId);
      sidebar.find("#img-cover").attr("src", cover);
      sidebar.find("#pembuat").html(pembuat);
      sidebar.find(datePicker).val(date);
      sidebar.find(datePicker).next(".form-control").val(dateToUse);
      sidebar.find(select2).val(label).trigger("change");
      sidebar.find(".assigned").empty();
      sidebar.find(".assigned").append(
        renderAvatar(avatars, false, "50", el.attr("data-members"), 32)
        // +
        //   "<li class='avatar avatar-add-member ms-50'>" +
        //   "<span class='avatar-content'>" +
        //   feather.icons["plus"].toSvg({ class: "avatar-icon" }) +
        //   "</li>"
      );
      validation_user(pembuatId);
      get_aktifitas(boardId);
      get_aktifitas_nhp(boardId);
      get_aktifitas_lhp(boardId);
    },
    buttonClick: function (el, boardId) {
      var addNew = document.createElement("form");
      addNew.setAttribute("class", "new-item-form");
      addNew.innerHTML =
        '<div class="mb-1">' +
        '<textarea class="form-control add-new-item" rows="2" placeholder="Topik Pekerjaan" required></textarea>' +
        "</div>" +
        '<div class="mb-2">' +
        '<button type="submit" class="btn btn-primary btn-sm me-1">Tambahkan</button>' +
        '<button type="button" class="btn btn-outline-secondary btn-sm cancel-add-item">Batal</button>' +
        "</div>";
      kanban.addForm(boardId, addNew);
      addNew.querySelector("textarea").focus();
      addNew.addEventListener("submit", function (e) {
        const d = new Date();
        let time = d.getTime();
        e.preventDefault();
        var currentBoard = $(".kanban-board[data-id='" + boardId + "']");
        kanban.addElement(boardId, {
          title: "<span class='kanban-text'>" + e.target[0].value + "</span>",
          id: boardId + "-" + id_member + "-" + time,
          pembuatId: id_member,
        });
        // console.log(boardId + "-" + id_member + "-" + time);
        // console.log(boardId);

        $.ajax({
          type: "POST",
          async: false,
          url:
            assetBoard + "auditor/add_board/" + id_penugasan + "/" + id_member,
          data: {
            nama_topik: e.target[0].value,
            board_id: boardId + "-" + id_member + "-" + time,
            board_position: boardId,
          },
          success: function (data) {
            // alert("success");
          },
        });

        currentBoard
          .find(".kanban-item:last-child .kanban-text")
          .before(renderDropdown());
        addNew.remove();
      });
      $(document).on("click", ".cancel-add-item", function () {
        $(this).closest(addNew).toggle();
      });
    },
    dragEl: function (el, source) {
    if(list_kt.includes(id_member)){
      $(el)
        .find(".item-dropdown, .item-dropdown .dropdown-menu.show")
        .removeClass("show");
    }
    },
    dropEl: function (el, target, source, sibling) {
    if(list_kt.includes(id_member)){
      var sourceId = $(source).closest("div.kanban-board").attr("data-id"),
        targetId = $(target).closest("div.kanban-board").attr("data-id");
      // console.log($(el).attr("data-eid"));
      // console.log(targetId);
      // console.log(kanban);
      // console.log(kanban.options.boards);

      $.ajax({
        type: "POST",
        async: false,
        url:
          assetBoard + "auditor/move_board/" + id_penugasan + "/" + id_member,
        data: {
          board_id: $(el).attr("data-eid"),
          board_position: targetId,
        },
        success: function (post) {
          ret = JSON.parse(post);
          if (ret.error == false) {
            $("#status-penugasan").html(ret.move);
          } else {
            Swal.fire({
              title: "Error! ",
              text: ret.error_msg,
              icon: "error",
              customClass: {
                confirmButton: "btn btn-danger",
              },
              buttonsStyling: !1,
            });
          }
        },
      });

      // console.log(kanban);
      // if (source === target) {
      //   console.log("INNER");
      // } else {
      //   console.log("SIDE");
      // }
    }
    },
  });

  if (kanbanWrapper.length) {
    new PerfectScrollbar(kanbanWrapper[0]);
  }

  // Render add new inline with boards
  // $('.kanban-container').append(addNewForm);

  // Change add item button to flat button
  $.each($(".kanban-title-button"), function (key) {
    $(this)
      .removeClass()
      .addClass("kanban-title-button btn btn-flat-secondary btn-sm ms-50");
    if (key>0) {
      $(this).addClass("hidden");
    }
    Waves.init();
    Waves.attach("[class*='btn-flat-']");
  });

  // Makes kanban title editable
  $(document).on("mouseenter", ".kanban-title-board", function () {
    $(this).attr("contenteditable", "true");
  });

  // Appends delete icon with title
  $.each($(".kanban-board-header"), function () {
    $(this).append(renderBoardDropdown());
  });

  // Deletes Board
  $(document).on("click", ".delete-board", function () {
    var id = $(this).closest(".kanban-board").data("id");
    kanban.removeBoard(id);
  });

  // Delete task
  $(document).on("click", ".dropdown-item.delete-task", function () {
    openSidebar = true;
    var id = $(this).closest(".kanban-item").data("eid");
    kanban.removeElement(id);
  });

  // Open/Cancel add new input
  $(".add-new-btn, .cancel-add-new").on("click", function () {
    addNewInput.toggle();
  });

  // Add new board
  addNewForm.on("submit", function (e) {
    e.preventDefault();
    var $this = $(this),
      value = $this.find(".form-control").val(),
      id = value.replace(/\s+/g, "-").toLowerCase();
    kanban.addBoards([
      {
        id: id,
        title: value,
      },
    ]);
    // Adds delete board option to new board & updates data-order
    $(".kanban-board:last-child")
      .find(".kanban-board-header")
      .append(renderBoardDropdown());

    // Remove current append new add new form
    addNewInput.val("").css("display", "none");
    $(".kanban-container").append(addNewForm);

    // Update class & init waves
    $.each($(".kanban-title-button"), function () {
      $(this)
        .removeClass()
        .addClass("kanban-title-button btn btn-flat-secondary btn-sm ms-50");
      Waves.init();
      Waves.attach("[class*='btn-flat-']");
    });
  });

  // Clear comment editor on close
  sidebar.on("hidden.bs.modal", function () {
    sidebar.find(".ql-editor")[0].innerHTML = "";
    sidebar.find(".nav-link-activity").removeClass("active");
    sidebar.find(".tab-pane-activity").removeClass("show active");
    sidebar.find(".nav-link-update").addClass("active");
    sidebar.find(".tab-pane-update").addClass("show active");
  });

  // Re-init tooltip when modal opens(Bootstrap bug)
  sidebar.on("shown.bs.modal", function () {
    $('[data-bs-toggle="tooltip"]').tooltip();
  });

  $(".update-item-form").on("submit", function (e) {
    e.preventDefault();
    sidebar.modal("hide");
  });

  // Render custom items
  $.each($(".kanban-item"), function () {
    var $this = $(this),
      $text = "<span class='kanban-text'>" + $this.text() + "</span>";
      $this.addClass($this.attr("data-class"));
    if (
      $this.attr("data-badge") !== undefined &&
      $this.attr("data-badge-text") !== undefined
    ) {
      $this.html(
        renderHeader($this.attr("data-badge"), $this.attr("data-badge-text")) +
          $text
      );
    }
    if (
      $this.attr("data-comments") !== undefined ||
      $this.attr("data-due-date") !== undefined ||
      $this.attr("data-assigned") !== undefined
    ) {
      $this.append(
        renderFooter(
          $this.attr("data-attachments"),
          $this.attr("data-comments"),
          $this.attr("data-assigned"),
          $this.attr("data-members")
        )
      );
    }
    if ($this.attr("data-image") !== undefined) {
      $this.html(
        renderHeader($this.attr("data-badge"), $this.attr("data-badge-text")) +
          "<img class='img-fluid rounded mb-50' src='" +
          assetPath +
          "cover/" +
          $this.attr("data-image") +
          "' height='32'/>" +
          $text +
          renderFooter(
            $this.attr("data-due-date"),
            $this.attr("data-comments"),
            $this.attr("data-assigned"),
            $this.attr("data-members")
          )
      );
    }
    $this.on("mouseenter", function () {
      $this
        .find(".item-dropdown, .item-dropdown .dropdown-menu.show")
        .removeClass("show");
    });
  });

  if (updateItemSidebar.length) {
    updateItemSidebar.on("hidden.bs.modal", function () {
      updateItemSidebar.find(".file-attachments").val("");
    });
  }
});

$("#btn-simpan").click(function (evt) {
  evt.preventDefault();
  var form = $("#form-pekerjaan")[0];
  var data = new FormData(form);
  $.ajax({
    url: site_url + "auditor/save_kertas_kerja",
    type: "post",
    enctype: "multipart/form-data",
    data: data,
    processData: false,
    // dataType: "json",
    // contentType: "application/json; charset=utf-8",
    contentType: false,
    cache: false,
    success: function (data) {
      data = JSON.parse(data);
      if (data.error == false) {
        Swal.fire({
          title: "Success!",
          text: data.error_msg,
          icon: "success",
          customClass: {
            confirmButton: "btn btn-primary",
          },
          buttonsStyling: !1,
        }).then(function () {
          window.location.reload(true);
        });
      } else {
        Swal.fire({
          title: "Error! ",
          text: data.error_msg,
          icon: "error",
          customClass: {
            confirmButton: "btn btn-danger",
          },
          buttonsStyling: !1,
        }).then(function () {
          window.location.reload(true);
        });
      }
    },
  });
});

$("#btn-hapus").click(function (evt) {
  evt.preventDefault();
  var form = $("#form-pekerjaan")[0];
  var data = new FormData(form);
  Swal.fire({
    title: "Hapus Kertas Kerja?",
    text: "Data yang dihapus tidak bisa dikembalikan!",
    icon: "warning",
    showCancelButton: !0,
    confirmButtonText: "Ya, Hapus!",
    customClass: {
      confirmButton: "btn btn-danger",
      cancelButton: "btn btn-outline-danger ms-1",
    },
    buttonsStyling: !1,
  }).then(function (t) {
    t.value &&
      $.ajax({
        url: site_url + "auditor/delete_kertas_kerja",
        type: "post",
        enctype: "multipart/form-data",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
          data = JSON.parse(data);
          Swal.fire({
            icon: "success",
            title: "Deleted!",
            text: "Kertas Kerja Telah Dihapus. \n" + data.error_msg,
            customClass: {
              confirmButton: "btn btn-success",
            },
          }).then(function () {
            window.location.reload(true);
          });
        },
      });
  });
});

$("#btn-aktifitas").click(function (e) {
  e.preventDefault();
  Swal.fire({
    title: "Mohon Tunggu!",
    html: "Sedang mengunggah dalam <b></b> detik.",
    icon: "success",
    timer: 5e3,
    timerProgressBar: !0,
    allowOutsideClick: false,
    didOpen: () => {
      $("#komentar_aktifitas").html(quillEl.root.innerHTML.trim());
      // $("#form-aktifitas").submit();
      var form = $("#form-aktifitas")[0];
      var data = new FormData(form);
      // console.log($("#komentar_aktifitas").val());
      $.ajax({
        url: site_url + "auditor/add_aktifitas",
        type: "post",
        enctype: "multipart/form-data",
        data: data,
        processData: false,
        // dataType: "json",
        // contentType: "application/json; charset=utf-8",
        contentType: false,
        cache: false,
        success: function (data) {
          data = JSON.parse(data);
          get_aktifitas(data.board_id);
        },
      });
      Swal.showLoading(),
        (t = setInterval(() => {
          const t = Swal.getHtmlContainer();
          if (t) {
            const n = t.querySelector("b");
            n && (n.textContent = Math.round(Swal.getTimerLeft() / 1000));
          }
        }, 100));
    },
    willClose: () => {
      clearInterval(t);
    },
  }).then((t) => {
    t.dismiss === Swal.DismissReason.timer;
    $(".update-item-sidebar").find(".ql-editor")[0].innerHTML = "";
    $(".update-item-sidebar").find("#attachments").val("");
    $(".update-item-sidebar").find("#komentar_aktifitas").html("");
  });
});

function get_aktifitas(boardId) {
  $("#list-aktifitas").html("");
  $.ajax({
    url: site_url + "auditor/get_aktifitas/" + boardId,
    type: "get",
    processData: false,
    contentType: false,
    cache: false,
    success: function (data) {
      // data = JSON.parse(data);
      $("#list-aktifitas").html(data);
    },
  });
}

function validation_user(pembuatId) {
  if (pembuatId == id_member || list_kt.includes(id_member)){
    $('#hidden-update').removeClass("hidden");
  } else {
    $('#hidden-update').addClass("hidden");
  }
  if (list_kt.includes(id_member)){
    $('#hidden-nhp').removeClass("hidden");
  } else {
    $('#hidden-nhp').addClass("hidden");
  }
  if (list_pt.includes(id_member)){
    $('#hidden-lhp').removeClass("hidden");
  } else {
    $('#hidden-lhp').addClass("hidden");
  }
}

$("#btn-aktifitas-nhp").click(function (e) {
  e.preventDefault();
  Swal.fire({
    title: "Mohon Tunggu!",
    html: "Sedang mengunggah dalam <b></b> detik.",
    icon: "success",
    timer: 5e3,
    timerProgressBar: !0,
    allowOutsideClick: false,
    didOpen: () => {
      var form = $("#form-aktifitas-nhp")[0];
      var data = new FormData(form);
      $.ajax({
        url: site_url + "auditor/add_aktifitas_nhp",
        type: "post",
        enctype: "multipart/form-data",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
          data = JSON.parse(data);
          get_aktifitas(data.board_id);
          get_aktifitas_nhp(data.board_id);
        },
      });
      Swal.showLoading(),
        (t = setInterval(() => {
          const t = Swal.getHtmlContainer();
          if (t) {
            const n = t.querySelector("b");
            n && (n.textContent = Math.round(Swal.getTimerLeft() / 1000));
          }
        }, 100));
    },
    willClose: () => {
      clearInterval(t);
    },
  }).then((t) => {
    t.dismiss === Swal.DismissReason.timer;
    $(".update-item-sidebar").find("#tanggal_nhp").val("");
    $(".update-item-sidebar").find("#attachments-nhp").val("");
  });
});

$("#btn-hapus-nhp").click(function (evt) {
  evt.preventDefault();
  var form = $("#form-aktifitas-nhp")[0];
  var data = new FormData(form);
  Swal.fire({
    title: "Tidak memiliki NHP?",
    text: "Tandai Kertas Kerja menjadi tidak memiliki NHP.",
    icon: "warning",
    showCancelButton: !0,
    confirmButtonText: "Ya, Tidak memiliki NHP!",
    customClass: {
      confirmButton: "btn btn-primary",
      cancelButton: "btn btn-outline-dark ms-1",
    },
    buttonsStyling: !1,
  }).then(function (t) {
    t.value &&
      $.ajax({
        url: site_url + "auditor/tidak_memiliki_nhp",
        type: "post",
        enctype: "multipart/form-data",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
          data = JSON.parse(data);
          get_aktifitas(data.board_id);
          get_aktifitas_nhp(data.board_id);
          Swal.fire({
            icon: "success",
            title: "Ditandai!",
            text:
              "Kertas Kerja telah ditandai tidak memiliki NHP. \n" +
              data.error_msg,
            customClass: {
              confirmButton: "btn btn-success",
            },
          });
        },
      });
  });
});

function get_aktifitas_nhp(boardId) {
  $("#list-aktifitas-nhp").html("");
  $.ajax({
    url: site_url + "auditor/get_aktifitas/" + boardId + "/nhp",
    type: "get",
    processData: false,
    contentType: false,
    cache: false,
    success: function (data) {
      // data = JSON.parse(data);
      $("#list-aktifitas-nhp").html(data);
    },
  });
  $("#status-nhp").html("");
  $.ajax({
    url: site_url + "auditor/get_status/" + boardId + "/nhp",
    type: "get",
    processData: false,
    contentType: false,
    cache: false,
    success: function (data) {
      // data = JSON.parse(data);
      $("#status-nhp").html(data);
    },
  });
}

$("#btn-aktifitas-lhp").click(function (e) {
  e.preventDefault();
  Swal.fire({
    title: "Mohon Tunggu!",
    html: "Sedang mengunggah dalam <b></b> detik.",
    icon: "success",
    timer: 5e3,
    timerProgressBar: !0,
    allowOutsideClick: false,
    didOpen: () => {
      var form = $("#form-aktifitas-lhp")[0];
      var data = new FormData(form);
      $.ajax({
        url: site_url + "auditor/add_aktifitas_lhp",
        type: "post",
        enctype: "multipart/form-data",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
          data = JSON.parse(data);
          get_aktifitas(data.board_id);
          get_aktifitas_lhp(data.board_id);
        },
      });
      Swal.showLoading(),
        (t = setInterval(() => {
          const t = Swal.getHtmlContainer();
          if (t) {
            const n = t.querySelector("b");
            n && (n.textContent = Math.round(Swal.getTimerLeft() / 1000));
          }
        }, 100));
    },
    willClose: () => {
      clearInterval(t);
    },
  }).then((t) => {
    t.dismiss === Swal.DismissReason.timer;
    $(".update-item-sidebar").find("#tanggal_lhp").val("");
    $(".update-item-sidebar").find("#attachments-lhp").val("");
  });
});

function get_aktifitas_lhp(boardId) {
  $("#list-aktifitas-lhp").html("");
  $.ajax({
    url: site_url + "auditor/get_aktifitas/" + boardId + "/lhp",
    type: "get",
    processData: false,
    contentType: false,
    cache: false,
    success: function (data) {
      // data = JSON.parse(data);
      $("#list-aktifitas-lhp").html(data);
    },
  });
  $("#status-lhp").html("");
  $.ajax({
    url: site_url + "auditor/get_status/" + boardId + "/lhp",
    type: "get",
    processData: false,
    contentType: false,
    cache: false,
    success: function (data) {
      // data = JSON.parse(data);
      $("#status-lhp").html(data);
    },
  });
}

/**
 * Created by Alberto on 24/11/2016.
 */

$.ajaxSetup({
    beforeSend: function (xhr) {
        xhr.setRequestHeader("Authorization", "Basic " + btoa("user:password"));
    }
});

var EventService = function () {
    this.add = function (params) {
        return $.post("/backend/webservices/add.php", params, function (response) {
        }, "json");
    };

    this.update = function (params) {
        return $.ajax("/backend/webservices/edit.php",{method:"PUT", data : params, dataType: "json"});
    };

    this.delete = function (id) {
        return $.ajax("/backend/webservices/delete.php",{method:"DELETE", data : { "id":id }, dataType: "json"});
    };

    this.list = function () {
        return $.get("/backend/webservices/list.php", {}, function () {
        }, "json");
    };
}

var eventManager = new EventService();


var Utils = function () {
    this.addRow = function (data) {
        var _table = $("#table-events");
        _table.find("tbody").append("<tr data-rel='" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td><td>" + data.type + "</td><td>" + data.date + "</td><td>" + this.actionButtons(data) + "</td></tr>")
    };

    this.updateRow = function (data){
        var _tr = $("#table-events tr[data-rel='"+data.id+"']"),
            _td = _tr.children("td");

        _td.eq(1).html(data.name);
        _td.eq(2).html(data.type);
        _td.eq(3).html(data.date);

    };

    this.deleteRow = function (id){
        $("#table-events tr[data-rel='"+id+"']").remove();
    };

    this.actionButtons = function (data) {
        return '<button type="button" data-rel="' + data.id + '" class="btn btn-success edit-btn">Edit</button> <button type="button" data-rel="' + data.id + '" class="btn btn-danger remove-btn">Remove</button>';
    };
}

var myUtils = new Utils(), _allEvents = {};

$(function () {
    eventManager.list().success(function (data) {
        _allEvents = data;
        $("#table-events tbody").empty();
        for (var i in data) {
            myUtils.addRow(data[i]);
        }
    });

    $("#formCreate").on("submit", function (e) {
        var _form = $(this);
        e.preventDefault();
        e.stopPropagation();
        eventManager.add($(this).serialize()).success(function (data) {
            _form.get(0).reset();
            myUtils.addRow(data);
            _allEvents[data.id] = data;
        }).error(function () {
            alert("There was an error please check your input again");
        });
    });

    $("#table-events tbody").on("click", ".edit-btn", function () {
        var _id = $(this).attr("data-rel");
        $("#idEdit").val(_allEvents[_id].id);
        $("#nameInputEdit").val(_allEvents[_id].name);
        $("#typeInputEdit").val(_allEvents[_id].type);
        $("#dateInputEdit").val(_allEvents[_id].date);
        $("#formEdit").show();
        $('html, body').animate({
            scrollTop: $("#formEdit").offset().top
        }, 1000);
    });

    $("#table-events tbody").on("click", ".remove-btn", function () {
        if (confirm("Do you really want to delete this Event?")){
            var _id = $(this).attr("data-rel");
            eventManager.delete(_id).success(function (data) {
                delete _allEvents[_id];
                myUtils.deleteRow(_id);
            }).error(function () {
                alert("There was an error please check your input again");
            });

        }
    });




    $("#formEdit").on("submit", function (e) {
        try{
            var _form = $(this);
            e.preventDefault();
            e.stopPropagation();
            eventManager.update($(this).serialize()).success(function (data) {
                _form.get(0).reset();
                $("#formEdit").hide();
                _allEvents[data.id] = data;
                myUtils.updateRow(data);
            }).error(function () {
                alert("There was an error please check your input again");
            });
        } catch (ex) {
            console.log(ex);
            return false;
        }

    })
});
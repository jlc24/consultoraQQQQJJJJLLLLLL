!(function (l) {
    "use strict";
    var e = function () {
        (this.$body = l("body")),
            (this.$modal = l("#event-modal")),
            (this.$event = "#external-events div.external-event"),
            (this.$calendar = l("#calendar")),
            (this.$saveCategoryBtn = l(".save-category")),
            (this.$categoryForm = l("#add-category form")),
            (this.$extEvents = l("#external-events")),
            (this.$calendarObj = null);
    };
    (e.prototype.onDrop = function (e, t) {
        var n = e.data("eventObject"),
            a = e.attr("data-class"),
            o = l.extend({}, n);
        (o.start = t), a && (o.className = [a]), this.$calendar.fullCalendar("renderEvent", o, !0), l("#drop-remove").is(":checked") && e.remove();
    }),
        (e.prototype.onEventClick = function (t, e, n) {
            var a = this,
                o = l("<form></form>");
            o.append("<label>Cambie el nombre del evento</label>"),
                o.append(
                    "<div class='input-group m-b-15'><input class='form-control' type=text value='" +
                        t.title +
                        "' /><span class='input-group-append'><button type='submit' class='btn btn-success btn-md waves-effect waves-light'><i class='fa fa-check'></i> Save</button></span></div>"
                ),
                a.$modal.modal({ backdrop: "static" }),
                a.$modal
                    .find(".delete-event")
                    .show()
                    .end()
                    .find(".save-event")
                    .hide()
                    .end()
                    .find(".modal-body")
                    .empty()
                    .prepend(o)
                    .end()
                    .find(".delete-event")
                    .unbind("click")
                    .click(function () {
                        a.$calendarObj.fullCalendar("removeEvents", function (e) {
                            return e._id == t._id;
                        }),
                            a.$modal.modal("hide");
                    }),
                a.$modal.find("form").on("submit", function () {
                    return (t.title = o.find("input[type=text]").val()), a.$calendarObj.fullCalendar("updateEvent", t), a.$modal.modal("hide"), !1;
                });
        }),
        (e.prototype.onSelect = function (n, a, e) {
            var o = this;
            o.$modal.modal({ backdrop: "static" });
            var i = l("<form></form>");
            i.append("<div class='row'></div>"),
                i
                    .find(".row")
                    .append("<div class='col-md-12'><div class='form-group'><label class='control-label'>Nombre del Evento</label><input class='form-control' placeholder='Ingrese el Nombre del Evento' type='text' name='title'/></div></div>")
                    .append("<div class='col-md-12'><div class='form-group'><label class='control-label'>Categoría</label><select class='form-control' name='category'></select></div></div>")
                    .find("select[name='category']")
                    .append("<option value='bg-secondary'>Jurídica</option>")
                    .append("<option value='bg-pink'>Contable</option>")
                    .append("<option value='bg-purple'>Marketing</option>")
                    .append("<option value='bg-warning'>Otro Evento</option></div></div>")
                    .append("<div class='col-md-12'><div class='form-group'><label class='control-label'>Nombre del Evento</label><input class='form-control' placeholder='Ingrese el Nombre del Evento' type='text' name='title'/></div></div>")
                    .append("<div class='col-md-12'><div class='form-group'><label class='control-label'>Hora de Inicio</label><input class='form-control' placeholder='Ingrese el Nombre del Evento' type='text' name='inicio'/></div></div>"),
                o.$modal
                    .find(".delete-event")
                    .hide()
                    .end()
                    .find(".save-event")
                    .show()
                    .end()
                    .find(".modal-body")
                    .empty()
                    .prepend(i)
                    .end()
                    .find(".save-event")
                    .unbind("click")
                    .click(function () {
                        i.submit();
                    }),
                o.$modal.find("form").on("submit", function () {
                    var e = i.find("input[name='title']").val(),
                        t = (i.find("input[name='beginning']").val(), i.find("input[name='ending']").val(), i.find("select[name='category'] option:checked").val());
                    return (
                        null !== e && 0 != e.length ? (o.$calendarObj.fullCalendar("renderEvent", { title: e, start: n, end: a, allDay: !1, className: t }, !0), o.$modal.modal("hide")) : alert("Tienes que darle un título a tu evento"), !1
                    );
                }),
                o.$calendarObj.fullCalendar("unselect");
        }),
        (e.prototype.enableDrag = function () {
            l(this.$event).each(function () {
                var e = { title: l.trim(l(this).text()) };
                l(this).data("eventObject", e), l(this).draggable({ zIndex: 999, revert: !0, revertDuration: 0 });
            });
        }),
        (e.prototype.init = function () {
            this.enableDrag();
            var e = new Date(),
                t = (e.getDate(), e.getMonth(), e.getFullYear(), new Date(l.now())),
                n = [
                    { title: "Hola!", start: new Date(l.now() + 158e6), className: "bg-purple" },
                    { title: "Reunión John Deo", start: t, end: t, className: "bg-success" },
                ],
                a = this;
            (a.$calendarObj = a.$calendar.fullCalendar({
                locale: 'es',
                slotDuration: "00:15:00",
                minTime: "08:00:00",
                maxTime: "19:00:00",
                defaultView: "month",
                handleWindowResize: !0,
                height: l(window).height() - 200,
                header: { left: "prev,next today", center: "title", right: "month,agendaWeek,agendaDay,listYear" },
                firstDay: 1,
                events: n,
                editable: !0,
                droppable: !0,
                eventLimit: !0,
                selectable: !0,
                drop: function (e) {
                    a.onDrop(l(this), e);
                },
                select: function (e, t, n) {
                    a.onSelect(e, t, n);
                },
                eventClick: function (e, t, n) {
                    a.onEventClick(e, t, n);
                },
            })),
                this.$saveCategoryBtn.on("click", function () {
                    var e = a.$categoryForm.find("input[name='category-name']").val(),
                        t = a.$categoryForm.find("select[name='category-color']").val();
                    null !== e &&
                        0 != e.length &&
                        (a.$extEvents.append('<div class="external-event bg-' + t + '" data-class="bg-' + t + '" style="position: relative;"><i class="mdi mdi-checkbox-blank-circle mr-2 vertical-middle"></i>' + e + "</div>"),
                        a.enableDrag());
                });
        }),
        (l.CalendarApp = new e()),
        (l.CalendarApp.Constructor = e);
})(window.jQuery),
    (function (e) {
        "use strict";
        window.jQuery.CalendarApp.init();
    })();

export function calendarRun()
{
    $.ajax({
        url: $('#calendar-container').data('href'),
        success: function (response) {
            return response.data
        },
        error: function () {
            
        }
    }).then(function(response){

        let newDate = new Date()

        // Get the modal
        var modal = document.getElementById("addEventsModal");
    
        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");
    
        // Get the Add Event button
        var addEvent = document.getElementById("add-e");
        // Get the Edit Event button
        var editEvent = document.getElementById("edit-event");
        // Get the Discard Modal button
        var discardModal = document.querySelectorAll("[data-dismiss='modal']")[0];
    
        // Get the Add Event button
        var addEventTitle = document.getElementsByClassName("add-event-title")[0];
        // Get the Edit Event button
        var editEventTitle = document.getElementsByClassName("edit-event-title")[0];
    
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
    
        // Get the all <input> elements insdie the modal
        
        var radioInput = document.querySelectorAll('input[type="radio"]');
    
        // Get the all <textarea> elements insdie the modal
        
    
    
        // When the user clicks on the button, open the modal
        // btn.onclick = function() {
        //     modal.style.display = "block";
        //     addEvent.style.display = 'block';
        //     editEvent.style.display = 'none';
        //     addEventTitle.style.display = 'block';
        //     editEventTitle.style.display = 'none';
        //     document.getElementsByTagName('body')[0].style.overflow = 'hidden';
        //     createBackdropElement();
        //     enableDatePicker();
        // }
    
        // Clear Data and close the modal when the user clicks on Discard button
        // discardModal.onclick = function() {
        //     modalResetData(modal);
        //     document.getElementsByTagName('body')[0].removeAttribute('style');
        // }
    
        // Clear Data and close the modal when the user clicks on <span> (x).
        span.onclick = function() {
            modalResetData(modal);
            document.getElementsByTagName('body')[0].removeAttribute('style');
        }
    
        // Clear Data and close the modal when the user clicks anywhere outside of the modal.
        window.onclick = function(event) {
            if (event.target == modal) {
                modalResetData(modal);
                document.getElementsByTagName('body')[0].removeAttribute('style');
            }
        }
    
        // let newDate = new Date()
    
        
    
       
        /* initialize the calendar
        -----------------------------------------------------------------*/
    
        // 2023-01-01T12:37:00
        // 2023-02-02T14:30:00
        var calendar = $('#calendar').fullCalendar({
            lang: 'ar',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },

            


            events: response.data,



            editable: true,
            eventLimit: true,
            // eventMouseover: function(event, jsEvent, view) {
            //     $(this).attr('id', event.id);
    
            //     $('#'+event.id).popover({
            //         template: '<div class="popover popover-primary" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
            //         title: event.title,
            //         content: event.description,
            //         placement: 'top',
            //     });
    
            //     $('#'+event.id).popover('show');
            // },
            eventMouseout: function(event, jsEvent, view) {
                $('#'+event.id).popover('hide');
            },
            eventClick: function(info) {
    
                // addEvent.style.display = 'none';
                // editEvent.style.display = 'block';
    
                addEventTitle.style.display = 'none';
                editEventTitle.style.display = 'block';
                modal.style.display = "block";
                document.getElementsByTagName('body')[0].style.overflow = 'hidden';
                // createBackdropElement();
    
                // Calendar Event Featch
                var eventTitle = info.title;
                var eventDescription = info.description;
    
                // Task Modal Input
                var taskTitle = $('#write-e');
                var taskTitleValue = taskTitle.val(eventTitle);
    
                var taskDescription = $('#taskdescription');
                var taskDescriptionValue = taskDescription.val(eventDescription);
    
                var taskInputStarttDate = $("#start-date");
                var taskInputStarttDateValue = taskInputStarttDate.val(info.start.format("YYYY-MM-DD HH:mm:ss"));
    
                var taskInputEndDate = $("#end-date");
                var taskInputEndtDateValue = taskInputEndDate.val(info.end.format("YYYY-MM-DD HH:mm:ss"));
            
                var startDate = flatpickr(document.getElementById('start-date'), {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    defaultDate: info.start.format("YYYY-MM-DD HH:mm:ss"),
                });
    
                var abv = startDate.config.onChange.push(function(selectedDates, dateStr, instance) {
                    var endtDate = flatpickr(document.getElementById('end-date'), {
                        enableTime: true,
                        dateFormat: "Y-m-d H:i",
                        minDate: dateStr
                    });
                })
    
                var endtDate = flatpickr(document.getElementById('end-date'), {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    defaultDate: info.end.format("YYYY-MM-DD HH:mm:ss"),
                    minDate: info.start.format("YYYY-MM-DD HH:mm:ss")
                });
    
                $('#edit-event').off('click').on('click', function(event) {
                    event.preventDefault();
                    /* Act on the event */
                    var radioValue = $("input[name='marker']:checked").val();
    
                    var taskStartTimeValue = document.getElementById("start-date").value;
                    var taskEndTimeValue = document.getElementById("end-date").value;
    
                    info.title = taskTitle.val();
                    info.description = taskDescription.val();
                    info.start = taskStartTimeValue;
                    info.end = taskEndTimeValue;
                    info.className = radioValue;
    
                    $('#calendar').fullCalendar('updateEvent', info);
                    modal.style.display = "none";
                    modalResetData(modal);
                    document.getElementsByTagName('body')[0].removeAttribute('style');
                });
            }
        })
    
    
        
        $("#add-e").off('click').on('click', function(event) {
    
            var radioValue = $("input[name='marker']:checked").val();
            var randomAlphaNumeric = randomString(10, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
            var inputValue = $("#write-e").val();
            var inputStarttDate = document.getElementById("start-date").value;
            var inputEndDate = document.getElementById("end-date").value;
    
            var arrayStartDate = inputStarttDate.split(' ');
    
            var arrayEndDate = inputEndDate.split(' ');
    
            var startDate = arrayStartDate[0];
            var startTime = arrayStartDate[1];
    
            var endDate = arrayEndDate[0];
            var endTime = arrayEndDate[1];
    
            var concatenateStartDateTime = startDate+'T'+startTime+':00';
            var concatenateEndDateTime = endDate+'T'+endTime+':00';
    
            var inputDescription = document.getElementById("taskdescription").value;
            var myCalendar = $('#calendar');
            myCalendar.fullCalendar();
            var myEvent = {
                timeZone: 'UTC',
                allDay : false,
                id: randomAlphaNumeric,
                title:inputValue,
                start: concatenateStartDateTime,
                end: concatenateEndDateTime,
                className: radioValue,
                description: inputDescription
            };
    
            console.log(myEvent);
            
            myCalendar.fullCalendar( 'renderEvent', myEvent, true );
            modal.style.display = "none";
            modalResetData(modal);
            document.getElementsByTagName('body')[0].removeAttribute('style');
        });
    
    
        // Setting dynamic style ( padding ) of the highlited ( current ) date
    
        
        setCurrentDateHighlightStyle();
    
        const mailScroll = new PerfectScrollbar('.fc-scroller', {
            suppressScrollX : true
        });
    
        var fcButtons = document.getElementsByClassName('fc-button');
        for(var i = 0; i < fcButtons.length; i++) {
            fcButtons[i].addEventListener('click', function() {
                const mailScroll = new PerfectScrollbar('.fc-scroller', {
                    suppressScrollX : true
                });        
                $('.fc-scroller').animate({ scrollTop: 0 }, 100);
                setCurrentDateHighlightStyle();
            })
        }
    });


   
}

// Create BackDrop ( Overlay ) Element
function createBackdropElement () {
    var btn = document.createElement("div");
    btn.setAttribute('class', 'modal-backdrop fade show')
    document.body.appendChild(btn);
}

// Reset radio buttons
function clearRadioGroup(GroupName) {
    var ele = document.getElementsByName(GroupName);
    for(var i=0;i<ele.length;i++)
    ele[i].checked = false;
}

// Reset Modal Data on when modal gets closed
function modalResetData(modal) {
    modal.style.display = "none";
    var input = document.querySelectorAll('#addEventsModal input[type="text"]');
    var textarea = document.querySelectorAll('#addEventsModal textarea');

    for (let i = 0; i < input.length; i++) {
        input[i].value = '';
    }
    for (let j = 0; j < textarea.length; j++) {
        textarea[j].value = '';
    }
    clearRadioGroup("marker");
    // Get Modal Backdrop
    // var getModalBackdrop = document.getElementsByClassName('modal-backdrop')[0];
    // document.body.removeChild(getModalBackdrop)
}

function getDynamicMonth( monthOrder ) {
    let newDate = new Date()
    let monthArray = [ '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12' ]
    var getNumericMonth = parseInt(monthArray[newDate.getMonth()]);
    var getNumericMonthInc = parseInt(monthArray[newDate.getMonth()]) + 1;
    var getNumericMonthDec = parseInt(monthArray[newDate.getMonth()]) - 1;

    if (monthOrder === 'default') {

        if (getNumericMonth < 10 ) {
            return '0' + getNumericMonth;
        } else if (getNumericMonth >= 10) {
            return getNumericMonth;
        }

    } else if (monthOrder === 'inc') {

        if (getNumericMonthInc < 10 ) {
            return '0' + getNumericMonthInc;
        } else if (getNumericMonthInc >= 10) {
            return getNumericMonthInc;
        }

    } else if (monthOrder === 'dec') {

        if (getNumericMonthDec < 10 ) {
            return '0' + getNumericMonthDec;
        } else if (getNumericMonthDec >= 10) {
            return getNumericMonthDec;
        }
    }
}


function enableDatePicker() {
    var startDate = flatpickr(document.getElementById('start-date'), {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: new Date()
    });

    var abv = startDate.config.onChange.push(function(selectedDates, dateStr, instance) {

        var endtDate = flatpickr(document.getElementById('end-date'), {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: dateStr
        });
    })

    var endtDate = flatpickr(document.getElementById('end-date'), {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: new Date()
    });
}


function randomString(length, chars) {
    var result = '';
    for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
    return result;
}

function setCurrentDateHighlightStyle() {
    let getCurrentDate = $('.fc-content-skeleton .fc-today').attr('data-date');
    if (getCurrentDate === undefined) {
        return;
    }
    let splitDate = getCurrentDate.split('-');
    if (splitDate[2] < 10) {
        $('.fc-content-skeleton .fc-today .fc-day-number').css('padding', '3px 8px');
    } else if (splitDate[2] >= 10) {
        $('.fc-content-skeleton .fc-today .fc-day-number').css('padding', '3px 4px');
    }
}
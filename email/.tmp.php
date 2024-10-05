<script>
      <!-- <div id="create-event">
                    <div class="control has-icons-left has-icons-right my-4">
                        <input class="input" type="text" placeholder="Event Name" name="building_name" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-building"></i>
                        </span>
                    </div>
                    <div class="control has-icons-left has-icons-right my-4">
                        <input class="input" type="text" placeholder="Conduct By" name="building_name" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-building"></i>
                        </span>
                    </div>
                    <div class="control has-icons-left my-2 ">
                    <div class="select is-fullwidth">
                        <select id="account_type" name="resource_type" required>
                            <option selected disabled>Event Type</option>
                            <option value="Lab">Tech Talk</option>
                            <option value="Auditorium">Lectures</option>
                            <option value="Classroom">Hands On Session</option>
                            <option value="Classroom">General Meeting</option>
                            <option value="Classroom">Other</option>

                        </select>
                    </div>
                    <span class="icon  is-left">
                        <i class="fas fa-table"></i>
                    </span>
                </div> -->
                </div>
    const create_event = document.getElementById("create-event");
    const event_btn =   document.getElementById("event-btn");
    const new_event =   document.getElementById("new_event");
    const submit_btn_occupy = document.getElementById("submit_btn_occupy");

    create_event.style.display = "none";

    event_btn.addEventListener('click',()=>{
        if(new_event.value == "false"){
            new_event.value = "true";
            create_event.style.display = "block";
            event_btn.innerHTML = `<span class="has-text-danger"><i class="fa-solid fa-x is-primary"></i> Cancel New Event</span>`
            submit_btn_occupy.innerHTML = "Create an Event & Occupy Resource"
        }else{
            new_event.value = "false";
            create_event.style.display = "none";
            event_btn.innerHTML = `<span class="has-text-primary"><i class="fa-solid fa-plus is-primary"></i> Create New Event</span>`
            submit_btn_occupy.innerHTML = "Occupy Resource"

        }
    })


   

</script>
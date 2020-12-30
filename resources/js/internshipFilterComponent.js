if(window.location.pathname == '/') { //important to not give errors on pages with other js features
    
    Vue.component('internship', { //component
        template: `<div class="internship__container">
        <a :href="'/companies/' + companies_id + '/internships/' + id"><h2>{{ title }}</h2></a>
        <div class="flexed">
            <P>Description:</p>
            <p class="flexed__item">{{ description }}</p>
        </div>
        <div class="flexed">
            <P>Tasks:</p>
            <p class="flexed__item">{{ tasks }}</p>
        </div>
        <section class="row">
            <div>
                <a :href="'/companies/' + companies_id">{{ name }}</a>
                <p>{{ postal_code }}, {{ city }}</p>
            </div>
        </section>  
        </div>`,
        props: [`companies_id`, `id`, `title`, `description`, `tasks`, `postal_code`, `city`, `name`, `picture`]
    });


    let nearbyInternships;
    let otherInternships;

    var nearby = new Vue({ //nearbyInternships
        el: "#internships",
        data: {
            internships: nearbyInternships    
        }
    })

    var others = new Vue({ //otherinternships
        el: "#others",
        data: {
            internships: otherInternships    
        }
    })

    document.querySelector('#btn-searchInternship').addEventListener('click', (e) => { //on form submit
        let type = document.querySelector('#inputTypeSelect').value
        let city = document.querySelector('#city').value
        let csfr = document.querySelector('input').value

        if (document.querySelector('.alert') == null && city === "" || type === "" || csfr === "") { //check if all fields are filled in
            let title = document.querySelector('.form__title')
            let div = `<div class="alert alert-danger" role="alert">Please fill in all fields</div>`
            title.insertAdjacentHTML('afterEnd', div)
        }else if (document.querySelector('.alert') != null && city === "" || type === "" === csfr != "") {
            //if some fields are still not filled in and already displaying error -> do nothing
        } else {

            let formData = new FormData() //get form data
            formData.append('type', type)
            formData.append('city', city)
            formData.append('csfr', csfr)

            fetch('/ajaxSearchInternshipCall', { //ajax call to get data from DB
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                })
                .then((response) => response.json())
                .then((result) => {
                    //reset titles in case they where changed with previous search
                    document.querySelector('.nearbyInternships').innerHTML = "Local internships"
                    document.querySelector('.otherInternships').innerHTML = "Internships in other cities"
                    //delete error message if set by previous form submit
                    if (document.querySelector('.alert') != null) {
                        document.querySelector('.alert').remove()
                    }
                    //set backend data 
                    nearbyInternships = JSON.parse(result.nearbyInternshipsJSON)
                    otherInternships = JSON.parse(result.otherInternshipsJSON)
                    //set backend data in Vue 
                    nearby.internships = nearbyInternships
                    others.internships = otherInternships
                    //display the titles above vue components on page
                    internshipTitles = document.querySelectorAll('.hidden')
                    internshipTitles.forEach(title => {
                        title.classList.remove('hidden')
                    });
                    //change titles if no relevant data found
                    if(nearbyInternships.length == 0) {
                        document.querySelector('.nearbyInternships').innerHTML = "No internships where currently found in this city"
                    }
                    if(otherInternships.length == 0) {
                        document.querySelector('.otherInternships').innerHTML = ""
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }
    })

}
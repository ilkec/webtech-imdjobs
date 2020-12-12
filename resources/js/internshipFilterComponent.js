if(window.location.pathname == '/') { //important to not give errors on pages with other vueJS features
    Vue.component('internship', {
        template: `<div>
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
        <hr>
        </div>`,
        props: [`companies_id`, `id`, `title`, `description`, `tasks`, `postal_code`, `city`, `name`, `picture`]
    });
    
    let nearbyField = document.querySelector('#internships')
    let otherField = document.querySelector('#others')

    if(nearbyField != null) {
        new Vue({
            el: "#internships",
            data: {
                internships: nearbyInternships,       
            }
        })
    }
    
    if(otherField != null) {
        new Vue({
            el:"#others",
            data: {
                internships: otherInternships
            }
        })
    }
}
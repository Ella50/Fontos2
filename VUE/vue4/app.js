Vue.component('custom-row', {
    data: function(){
        return {
            counter: 0
        }
    },
    template: `
        <tr>
            <td>
                <button @click="counter++"> Add 1 </button>
            </td>
            <td>
                {{counter}}
            </td>
        </tr>
    `
})

let app = new Vue({
    el: '#app',
})
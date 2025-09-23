/*Vue.component('button-counter', {
    data: function () {
      return {
        counter: 0
      }
    },
    template: `
        <div>
            <button @click="counter++">Add 1</button> 
            Counter: {{ counter }}
        </div>
        `
  })

Vue.component('component-a', {
    template: `<div>Component A</div>`
  })

Vue.component('component-b', {
    template: `<div><component-a></component-a>Component B</div>`
  })

Vue.component('component-c', {
    template: `<div>Component C</div>`
  })


let ComponentA = {
    template: `<div>Component A</div>`
  }

let ComponentB = {
    template: `<div><component-a></component-a>Component B</div>`
  }

let ComponentC = {
    template: `<div>Component C</div>`
  }

Vue.component('hello-user', {
    //props: ['name'], //tulajdonság
    props:{
        name: {
            type: String,
            required: true,
            default: 'John'
        }
    },
    template: `<div>Hello {{ name }}.</div>`
  })


Vue.component('button-counter', {
    props: ['counter'],
    template: `
        <div>
            <button @click="$emit('add-some', 1)">Add 1</button>
            <button @click="$emit('add-some', 5)">Add 5</button>

            <span>Counter: {{ counter }}</span>
        </div>
    `,
    })
*/

let myMixin = {
    created() {
        this.hello();
    },
    methods: {
        hello() {
            console.log('Hello from mixin');
        }
    }
}

Vue.component('button-counter', {
    mixins: [myMixin],
    data() {
        return {
            counter: 0
        }
    },
    template: `
        <div>
            <button @click="counter++">Add 1</button> 
            Counter: {{ counter }}
        </div>
        `
})

Vue.component('custom-input', {
    props: ['value'],
    template: `
    <input :value="value" @input="$emit('input', $event.target.value)" />
    `
})


Vue.component('hello-user', {
    props: ['name'],
    template: `<div>Szia, <slot></slot>!</div>` //tartalomként kerül be
})

let app = new Vue({
    el: '#app',
    /*components: {
        'component-a': ComponentA,
        'component-b': ComponentB,
    },*/
    data:{
        //userName: 'Aladár'
        counter: 0,
        inputText: 'Hello, world!',
        name: 'Aladár',
    },
    /*methods: {
        addSome(amount) {
            this.counter += amount;
        }
    }*/

    
  })
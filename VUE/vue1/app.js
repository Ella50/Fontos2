new Vue({
    el: '#app',  //element: hivatkozás az adatkötéshez
    data:{ //újabb objektumaz objektummal --> hello helyén az összekapcsolás miatt a szöveg
        hello: 'Hello world!',
        tooltip: 'This is a tooltip',
        //myStyle: 'redText',
        color: 'redText',
        fontWeight: 'boldText',
        styleObject: { //objektum a style-hoz
            color: 'blue',
            fontSize: '20px',
        },
        myHeader: '<h2>My Header</h2>',
        reverseHello: '',
        showHelloWorld: true,
        a: 5,

        fruits: ['Apple', 'Banana', 'Cherry' ],
        person: {
            firstName: 'John',
            lastName: 'Doe',
            age: 30,
        },

        counter: 0,
        counterMasik: 0,

        mouseEventStatus: 'Start',

        inputText: 'Hello Woorld',

    },
    created: function(){ //létrehozáskor lefutó függvény
        console.log('Vue instance created');
    },

    methods: { 
        /*reverseHello(){
            return this.hello.split('').reverse().join(''); //this: a Vue instance-re hivatkozik
        },*/

        capitalizeHello(){
            return this.hello.toUpperCase();
        },

        add(x, y){
            return x + y;
        },

        addOne(event){
            /*if (event){
                event.preventDefault(); //alapértelmezett esemény leállítása (nem lehet megnyitni a linket ebben az esetben)
            }*/
            this.counter += 1;
        },

        addSomething(valueToAdd){
            this.counterMasik += valueToAdd;
        },

        performMouseOver(){
            this.mouseEventStatus = 'Mouse Over';
        },

        performMouseOut(){
            this.mouseEventStatus = 'Mouse Out';
        },
    },

    watched: {
        hello(newValue){
            this.reverseHello = newValue.split('').reverse().join('');
        }
    },

    created(){
        this.reverseHello = this.hello.split('').reverse().join('');
    },

    computed: {
        reverseHello(){
            return this.hello.split('').reverse().join('');
        }

    },
})
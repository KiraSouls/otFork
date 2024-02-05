 class Slider{
    constructor({ elements, animationFunc, speed }){
        this.elements = elements;
        this.animationFunc = animationFunc;

        this.index = 0;
        this.size = elements.length;

        this.speed = speed;

        this.innerNext = this.innerNext.bind(this);
        this.stop = this.stop.bind(this);

        this.next = this.next.bind(this);
        this.prev = this.prev.bind(this);
    }
    
    innerNext(){
        this.index++;
        if(this.index >= this.size) this.index=0;

        
        this.animationFunc(this.elements[this.index]);

    }

    innerPrev(){
        this.index--;
        if(this.index < 0) this.index= this.size -1;
        console.log(this.elements[this.index]);
        this.animationFunc(this.elements[this.index]);
    }

    next(){
        this.innerNext();
        if(this.interval){
            this.stop();
            this.play();
        }
    }

    prev(){
        this.innerPrev();
        if(this.interval){
            this.stop();
            this.play();
        }
    }

    play(){
        this.interval = setInterval(this.innerNext,this.speed)
    }

    stop(){
        clearInterval(this.interval);
    }
}

const elements = [
    {
        title:'$2.500',
        subtitle:'Promoción estudiante',
        image: './img/estudiante.jpg',
        text: '-Café late <br> -Cinnamon roll'
    },
    {
        title:'$2.500',
        subtitle:'Promoción estudiante',
        image: './img/estudiante2.jpg',
        text: '-Café Americano <br> -Kladdkaka'
    },
    {
        title:'$3.500',
        subtitle:'Promoción Comunidad FIka',
        image: './img/3500.jpg',
        text: '-Café <br> -Sandwich Panini'
    },{
        title:'$5.900',
        subtitle:'Promoción Comunidad FIka',
        image: './img/5900.jpg',
        text: '-Café <br> -Sandwich Panini <br -Jugo <br> -Cinnamon roll'
    },{
        title:'$6.000',
        subtitle:'Promoción convenio',
        image: './img/lunchpromo.jpg',
        text: '-Ensalada <br> -Café <br> -Jugo'
    }
];

class Preloader {
    static preloadImages({images, completed}){
        const promises = images.map(imagePath => Preloader.preloadImage({imagePath}) );

        Promise.all(promises).then(completed);
    }

    static preloadImage({imagePath}){
        return new Promise((res,rej)=>{
        let image = new Image();
        image.src = imagePath;
        image.onload = res;
        })
    }
}

let sliderText = document.querySelector("#slider-text");
let sliderTitle = document.querySelector("#slider-title");
let sliderSubTitle = document.querySelector("#slider-subtitle");
let sliderImage = document.querySelector("#slider-image");
let textContent = document.querySelector("#slider-text-content");

let leftArrow = document.querySelector(".left-arrow");
let rightArrow = document.querySelector(".right-arrow");



let slider = new Slider({
    elements,
    animationFunc: function(element){

        textContent.classList.add("hide");
        sliderImage.classList.add("hide");

        setTimeout(function(){
        
        sliderTitle.innerHTML = element.title;
        sliderSubTitle.innerHTML = element.subtitle;
        sliderText.innerHTML = element.text;
        sliderImage.src = element.image;

        textContent.classList.remove("hide");
        sliderImage.classList.remove("hide");

        },600);


    },
    speed: 4000
});

slider.play();

leftArrow.addEventListener('click',slider.prev);
rightArrow.addEventListener('click',slider.next);

const imagePaths = elements.map(el => el.image);

Preloader.preloadImages({
    images: imagePaths,
    completed: function(){
        document.querySelector(".controls").style.display = "block";
    }
})
export default class Slider{
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




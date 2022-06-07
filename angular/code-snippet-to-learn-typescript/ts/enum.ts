enum bands {
    Motorhead,
    Metallica,
    Slayer
}
// console.log(bands);
let myFavoriteBand = bands.Slayer;
console.log(myFavoriteBand);
console.log(bands[2]);

const myMessage = (text: string): never => {
    throw new Error(text);
}
const myError = () => Error('Some text here');

function neverHappen(someVariable: any) {
    if (typeof someVariable === "string" && typeof someVariable === "number") {
        console.log(someVariable);
    }
}
neverHappen('text');
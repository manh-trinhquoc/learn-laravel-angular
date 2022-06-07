"use strict";
var bands;
(function (bands) {
    bands[bands["Motorhead"] = 0] = "Motorhead";
    bands[bands["Metallica"] = 1] = "Metallica";
    bands[bands["Slayer"] = 2] = "Slayer";
})(bands || (bands = {}));
// console.log(bands);
let myFavoriteBand = bands.Slayer;
console.log(myFavoriteBand);
console.log(bands[2]);
const myMessage = (text) => {
    throw new Error(text);
};
const myError = () => Error('Some text here');
function neverHappen(someVariable) {
    if (typeof someVariable === "string" && typeof someVariable === "number") {
        console.log(someVariable);
    }
}
neverHappen('text');
//# sourceMappingURL=enum.js.map
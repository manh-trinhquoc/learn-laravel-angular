"use strict";
function genericFunction(arg) {
    let myGenericArray = [];
    myGenericArray.push(arg);
    return myGenericArray;
}
let stringFromGenericFunction = genericFunction("Some string goes here");
console.log(stringFromGenericFunction[0]);
let numberFromGenericFunction = genericFunction(190);
console.log(numberFromGenericFunction[0]);
let numberFromGenericFunction2 = genericFunction(190);
console.log(numberFromGenericFunction2[0]);
//# sourceMappingURL=generic.js.map
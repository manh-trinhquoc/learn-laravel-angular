//  for browser use Require.js
// import MyBand = require('./export');
// console.log(MyBand());

// for nodejs use common.js
import { MyBand } from './export';
console.log(new MyBand(['ZZ Top', 'Motorhead'], 3));
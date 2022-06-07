"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.MyBand = void 0;
class MyBand {
    constructor(albums_list, total_members) {
        this.albums = albums_list;
        this.members = total_members;
    }
    // Methods
    listAlbums() {
        console.log("My favorite albums: ");
        for (var i = 0; i < this.albums.length; i++) {
            console.log(this.albums[i]);
        }
    }
}
exports.MyBand = MyBand;
//# sourceMappingURL=export.js.map
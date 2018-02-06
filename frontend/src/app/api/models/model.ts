export class Model {

    public constructor(data?: Object) {
        if (data) {
            this.fill(data);
        }
    }

    public fill(data: Object) {
        Object.assign(this, data);
        return this;
    }

}
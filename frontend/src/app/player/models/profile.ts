import { Model } from "../../api/models/model";
import { Picture } from "./picture";

export class Profile extends Model {
    public id: number;
    public introduction: string;
    public picture: Picture;
    public picture_id: number;

    public fill(data: Object) {
        super.fill(data);
        this.picture = new Picture().fill(data['picture']);
        return this;
    }
}
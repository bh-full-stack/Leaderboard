import { Model } from "../../api/models/model";
import { Profile } from "./profile";

export class Player extends Model {
    public id: number;
    public name: string;
    public email: string;
    public password: string;
    public has_deletable_rounds: boolean;
    public profile: Profile;

    public fill(data: Object) {
        super.fill(data);
        if (data['profile']) {
            this.profile = new Profile().fill(data['profile']);
        }
        return this;
    }
}
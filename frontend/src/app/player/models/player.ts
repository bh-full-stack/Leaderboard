import { Profile } from "./profile";


export class Player {
    public id: number;
    public name: string;
    public email: string;
    public password: string;
    public has_deletable_rounds: boolean;
    public profile: Profile;
}
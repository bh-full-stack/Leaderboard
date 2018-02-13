import { Player } from './../../player/models/player';
import { Model } from "../../api/models/model";

export class Squad extends Model {
    public id: number;
    public name: string;
    public color: string;
    public player_id: number;
    public players: Player[];
}
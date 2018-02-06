import { Model } from "../../api/models/model";
import { environment } from "../../../environments/environment";

export class Picture extends Model {
    id: number;
    extension: string;
    mime_type: string;
    width: number;
    height: number;
    size: number;
    
    public getUrl() {
        return `${environment.storageEndPoint}pictures/${this.id}.${this.extension}`;
    }
}
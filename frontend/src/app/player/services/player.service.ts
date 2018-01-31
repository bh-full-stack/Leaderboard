import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';

import { environment } from '../../../environments/environment';
import { Player } from '../models/player';

@Injectable()
export class PlayerService {

  public constructor(private _http: HttpClient) { }

  public register(player: Player): Observable<Response> {
    return this._http.post<Response>(
      environment.apiEndPoint + 'register',
      player
    );
  }

  public activate(activationCode: number): Observable<Player> {
    return this._http.post<Player>(
      environment.apiEndPoint + 'register/activate',
      { 
        activation_code: activationCode
      }
    );  
  }

}

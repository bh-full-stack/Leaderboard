import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';

import { Player } from '../models/player';
import { ApiService } from '../../api/services/api.service';

@Injectable()
export class PlayerService  extends ApiService {

  public register(player: Player, introduction: string): Observable<Response> {
    return this.request(
      'POST',
      'register',
      {
        'player': player,
        'introduction': introduction
      }
    );
  }

  public activate(activationCode: number): Observable<Player> {
    return this.request(
      'POST',
      'register/activate',
      { 
        activation_code: activationCode
      }
    );  
  }

  public handleOldScores(password: string, action: string): Observable<Response> {
    return this.request(
      'POST',
      'profile/handle-old-scores',
      { 
        'password': password,
        'old-scores-action': action
      }
    );  
  }

  public showProfile(player_id: number): Observable<Player> {
    return this.request(
      'GET',
      'profile/' + player_id
    );  
  }

  public updateIntroduction(player_id: number, introduction: string): Observable<Response> {
    return this.request(
      'PUT',
      'profile/' + player_id,
      {
        'introduction': introduction
      }
    ); 
  }

}

import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';

import { Player } from '../models/player';
import { ApiService } from '../../api/services/api.service';
import { Profile } from '../models/profile';

@Injectable()
export class PlayerService  extends ApiService {

  protected _modelClass = Player;

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
    return this.request<Player>(
      'GET',
      'profile/' + player_id
    );  
  }

  public updateProfile(player_id: number, profile: Profile): Observable<Response> {
    return this.request(
      'PUT',
      'profile/' + player_id,
      profile
    ); 
  }

}

import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { Observable } from 'rxjs/Observable';
import { Subject } from 'rxjs/Subject';

import { environment } from '../../../environments/environment';
import { Player } from '../../player/models/player';

@Injectable()
export class AuthService {

  public player: Player;
  public token: string;

  constructor(private _http: HttpClient, private _router: Router) {
    this._loadFromStorage();
  }

  public login(player: any): Observable<Response> {
    const observable: Observable<Response> = this._http.post<Response>(
      environment.apiEndPoint + 'auth',
      player
    );
    const subject = new Subject<any>();
    observable.subscribe(
      (response: Response) => {
        this.player = response['player'];
        this.token = response['token'];
        this._saveToStorage();
        subject.next(response);
      },
      (error: any) => {
        this.token = undefined;
        subject.error(error);
      }
    );
    return subject.asObservable();
  }

  public logout(): void {
    this.player = undefined;
    this.token = undefined;
    this._saveToStorage();
    this._router.navigate(['/']);
  }

  private _saveToStorage(): void {
    if (this.token) {
      localStorage.setItem('token', this.token);
    } else {
      localStorage.removeItem('token');
    }
    if (this.player) {
      localStorage.setItem('player', JSON.stringify(this.player));
    } else {
      localStorage.removeItem('player');
    }
  }

  private _loadFromStorage(): void {
    this.token = localStorage.getItem('token');
    const playerString: string = localStorage.getItem('player');
    this.player = playerString ? JSON.parse(playerString) : undefined;
  }

}

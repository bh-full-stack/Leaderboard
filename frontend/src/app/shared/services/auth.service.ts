import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { Observable } from 'rxjs/Observable';
import { Subject } from 'rxjs/Subject';

import { environment } from '../../../environments/environment';
//import { User } from '../../user/';

@Injectable()
export class AuthService {

  public user: any;
  public token: string;

  constructor(private _http: HttpClient, private _router: Router) {
    this._loadFromStorage();
  }

  public login(user: any): Observable<Response> {
    const observable: Observable<Response> = this._http.post<Response>(
      environment.apiEndPoint + 'auth',
      user
    );
    const subject = new Subject<any>();
    observable.subscribe(
      (response: Response) => {
        this.user = response['user'];
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
    this.user = undefined;
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
    if (this.user) {
      localStorage.setItem('user', JSON.stringify(this.user));
    } else {
      localStorage.removeItem('user');
    }
  }

  private _loadFromStorage(): void {
    this.token = localStorage.getItem('token');
    const userString: string = localStorage.getItem('user');
    this.user = userString ? JSON.parse(userString) : undefined;
  }

}

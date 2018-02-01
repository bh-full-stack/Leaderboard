import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';
import { Subject } from 'rxjs/Subject';

import { AuthService } from '../services/auth.service';
import { environment } from '../../../environments/environment';

@Injectable()
export class ApiService {

  public constructor(protected _http: HttpClient, protected _authService: AuthService) {
    //
  }

  public request(method: string, url: string, body?: any): Observable<any> {
    const observable = this._http.request(
      method,
      environment.apiEndPoint + url,
      {
        body: body,
        headers: this._getHeaders()
      }
    );
    const subject = new Subject<any>();
    observable.subscribe(
      response => subject.next(response),
      errorResponse => {
        console.log(errorResponse);
        if (errorResponse.status == 401) {
          window.alert('Your session has expired!');
          this._authService.logout('player/login');
        }        
        subject.error(errorResponse);
      },
      () => subject.complete()
    );
    return subject.asObservable();
  }

  private _getHeaders(): {[key: string]: string} {
    const headers = {
      'Content-Type': 'application/json',
      'Access-Control-Allow-Origin': '*',
    };
    if (this._authService.token) {
      headers['Authorization'] = 'Bearer ' + this._authService.token;
    }
    return headers;
  }

}

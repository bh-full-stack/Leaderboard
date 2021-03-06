import { Injectable } from '@angular/core';
import { Observable } from 'rxjs/Observable';

import { ApiService } from '../../api/services/api.service';
import { Squad } from '../models/squad';

@Injectable()
export class SquadService extends ApiService {

  public create(squad: Squad): Observable<Squad> {
    return this.request<Squad>(
      'POST',
      'squad',
      squad
    );
  }

  public list(): Observable<Squad[]> {
    return this.request<Squad[]>(
      'GET',
      'squad'
    );
  }

  public listWithAuth(): Observable<Squad[]> {
    return this.request<Squad[]>(
      'GET',
      'squad/auth'
    );
  }

  public join(squad): Observable<void> {
    return this.request<void>(
      'POST',
      'squad/join',
      squad
    );
  }
  
  public leave(squad): Observable<void> {
    return this.request<void>(
      'POST',
      'squad/leave',
      squad
    );
  }

  public show(squadId): Observable<Squad> {
    return this.request<Squad>(
      'GET',
      `squad/${squadId}`
    );
  }

}

import { Injectable } from '@angular/core';
import { Observable } from 'rxjs/Observable';

import { ApiService } from '../../api/services/api.service';
import { Squad } from '../models/Squad';

@Injectable()
export class SquadService extends ApiService {

  public create(squad: Squad): Observable<Squad> {
    return this.request<Squad>(
      'POST',
      'squad',
      {
        'squad': squad
      }
    );
  }
}

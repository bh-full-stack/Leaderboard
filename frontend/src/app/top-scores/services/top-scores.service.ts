import { Injectable } from '@angular/core';
import { Observable } from 'rxjs/Observable';

import { ApiService } from '../../shared/services/api.service';

@Injectable()
export class TopScoresService extends ApiService {

  public list(): Observable<any[]> {
    return this.request('GET', 'rounds');
  }

}

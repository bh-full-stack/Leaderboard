import { Injectable } from '@angular/core';
import { Observable } from 'rxjs/Observable';

import { ApiService } from '../../shared/services/api.service';

@Injectable()
export class TopScoresService extends ApiService {

  public list(sortBy: string, sortDirection: string): Observable<any[]> {
    return this.request(
      'GET',
      `rounds?sortBy=${sortBy}&sortDirection=${sortDirection}`
    );  
  }

  public listGames() {
    return this.request('GET', 'rounds/games')
  }
}

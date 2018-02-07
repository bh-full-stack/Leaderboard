import { Injectable } from '@angular/core';
import { Observable } from 'rxjs/Observable';

import { ApiService } from '../../api/services/api.service';

@Injectable()
export class TopScoresService extends ApiService {

  public list(game: string, sortBy: string, sortDirection: string): Observable<any[]> {
    return this.request(
      'GET',
      `rounds?game=${game}&sortBy=${sortBy}&sortDirection=${sortDirection}`
    );  
  }

  public listGames() {
    return this.request<string[]>('GET', 'rounds/games')
  }
}

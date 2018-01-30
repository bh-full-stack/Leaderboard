import { TestBed, inject } from '@angular/core/testing';

import { TopScoresService } from './top-scores.service';

describe('TopScoresService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [TopScoresService]
    });
  });

  it('should be created', inject([TopScoresService], (service: TopScoresService) => {
    expect(service).toBeTruthy();
  }));
});

import { TestBed, inject } from '@angular/core/testing';

import { SquadService } from './squad.service';

describe('SquadService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [SquadService]
    });
  });

  it('should be created', inject([SquadService], (service: SquadService) => {
    expect(service).toBeTruthy();
  }));
});

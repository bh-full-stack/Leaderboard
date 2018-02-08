import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { OldScoresHandlerComponent } from './old-scores-handler.component';

describe('OldScoresHandlerComponent', () => {
  let component: OldScoresHandlerComponent;
  let fixture: ComponentFixture<OldScoresHandlerComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ OldScoresHandlerComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(OldScoresHandlerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

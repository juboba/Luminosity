'use strict';

describe('Service: Task', function () {

  // load the service's module
  beforeEach(module('publicApp'));

  // instantiate service
  var Task;
  beforeEach(inject(function (_Task_) {
    Task = _Task_;
  }));

  it('should do something', function () {
    expect(!!Task).toBe(true);
  });

});

"""
test
"""
# pylint: disable=C0116
import threading
import time
from random import randrange
from prefect import task, Flow, Parameter, context
#from prefect.executors import DaskExecutor
from prefect.executors import LocalDaskExecutor

logger = context.get("logger")
logger.handlers = []


@task
def random_num(stop):
    number = 0
    for iter in range(1000):
        number += randrange(stop)
    #print(f"[{threading.get_native_id()}] Your number is {number}")
    return number


@task
def sum_numbers(numbers):
    print("in totale ottengo: " + str(sum(numbers)))


def create_flow(repeatcount: int) -> Flow:
    with Flow("parallel-execution") as flow:
        stop = Parameter("stop")

        global sum_numbers
        tasks = []
        for i in range(repeatcount):
            tasks.append(random_num(stop))
        sum_numbers = sum_numbers(numbers=tasks)

    return flow


def run(flow: Flow, multithread: bool):
    start = time.time()

    executor = None
    prefix = "single"
    if multithread:
        executor = LocalDaskExecutor()
        prefix = "multi"

    print(f"starting {prefix} thread test...")

    flow_state = flow.run(parameters={"stop": 125}, executor=executor)
    end = time.time()
    elapsedtime = end - start
    print(f"{prefix} thread elapsed time: {elapsedtime} secs")
    print("-" * 100)
    return flow_state


MAXITER = 150
_flow = create_flow(MAXITER)
flow_state = run(flow=_flow, multithread=False)
flow_state = run(flow=_flow, multithread=True)

#_flow.visualize(flow_state=flow_state)
#_flow.visualize()

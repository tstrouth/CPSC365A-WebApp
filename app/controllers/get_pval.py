#given a test statistic and degrees of freedom will return a probability
import sys
from scipy import stats
import numpy as np
test_stat = float(sys.argv[1])
df = float(sys.argv[2])
pval = stats.t.sf(np.abs(test_stat), df)*2
print(pval)

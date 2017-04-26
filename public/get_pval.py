from scipy import stats
import sys
#takes the first argument after file name which should be test stat 
t_stat = float(sys.argv[1])
#following test stat is degrees of freedom
df = float(sys.argv[2])
#returns two sided p-val Pr(abs(t) > t_stat
pval = stats.t.sf(abs(t_stat), df)*2

print(pval)



